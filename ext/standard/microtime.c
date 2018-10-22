/*
   +----------------------------------------------------------------------+
   | PHP Version 7                                                        |
   +----------------------------------------------------------------------+
   | Copyright (c) 1997-2018 The PHP Group                                |
   +----------------------------------------------------------------------+
   | This source file is subject to version 3.01 of the PHP license,      |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.php.net/license/3_01.txt                                  |
   | If you did not receive a copy of the PHP license and are unable to   |
   | obtain it through the world-wide-web, please send a note to          |
   | license@php.net so we can mail you a copy immediately.               |
   +----------------------------------------------------------------------+
   | Author: Paul Panotzki - Bunyip Information Systems                   |
   +----------------------------------------------------------------------+
 */

#include "php.h"

#ifdef HAVE_SYS_TYPES_H
#include <sys/types.h>
#endif
#ifdef PHP_WIN32
#include "win32/time.h"
#include "win32/getrusage.h"
#else
#include <sys/time.h>
#endif
#ifdef HAVE_SYS_RESOURCE_H
#include <sys/resource.h>
#endif
#ifdef HAVE_UNISTD_H
#include <unistd.h>
#endif
#include <stdlib.h>
#include <string.h>
#include <stdio.h>
#include <errno.h>

#include "microtime.h"
#include "ext/date/php_date.h"

#define SEC_IN_MIN 60

#ifdef HAVE_GETTIMEOFDAY

#define CONVERT_TIMEVAL_TO_NUMBER(tv, scale, type) (((type)(tv).tv_sec * (type)(scale)) + ((type)(tv).tv_usec / ((type)TIME_SCALE_USECS / (type)(scale))))
#define CONVERT_TIMEVAL_TO_LONG(tv, scale) CONVERT_TIMEVAL_TO_NUMBER(tv, scale, zend_long)
#define CONVERT_TIMEVAL_TO_DOUBLE(tv, scale) CONVERT_TIMEVAL_TO_NUMBER(tv, scale, double)

/* {{{ proto mixed microtime([bool get_as_float])
   Returns either a string or a float containing the current time in seconds and microseconds */
PHP_FUNCTION(microtime)
{
	int32_t scale = 0;
	int round = 0;
	struct timeval tv;

	if (EXPECTED(ZEND_NUM_ARGS() > 0)) {
		zval *zformat;

		ZEND_PARSE_PARAMETERS_START(0, 1)
			Z_PARAM_OPTIONAL
			Z_PARAM_ZVAL(zformat)
		ZEND_PARSE_PARAMETERS_END();

		switch (Z_TYPE_P(zformat)) {
			case IS_LONG:
				scale = (int32_t)(Z_LVAL_P(zformat) & ~TIME_FORMAT_INT);
				round = (Z_LVAL_P(zformat) & TIME_FORMAT_INT) != 0;
				break;

			case IS_TRUE:
				scale = 1;
				break;

			case IS_FALSE:
				break;

			default:
				if (UNEXPECTED(ZEND_ARG_USES_STRICT_TYPES())) {
					zend_type_error("microtime() expects parameter 1 to be integer or boolean, %s given", zend_zval_type_name(zformat));
					return;
				}
				scale = zend_is_true(zformat);
		}
	}

	if (UNEXPECTED(gettimeofday(&tv, NULL) != SUCCESS)) {
		RETURN_FALSE;
	}

	if (UNEXPECTED(scale == 0)) {
		RETURN_NEW_STR(zend_strpprintf(0, "%.8F %ld", (double)tv.tv_usec / TIME_SCALE_USECS, (long)tv.tv_sec));
	}

	if (EXPECTED(!round)) {
		RETURN_DOUBLE(CONVERT_TIMEVAL_TO_DOUBLE(tv, scale));
	}

	switch (scale) {
		case TIME_SCALE_SECS:
			RETURN_LONG((zend_long)tv.tv_sec);

#if SIZEOF_ZEND_LONG > 4
		/* optimized special-cases for common units using integer math
		   on 64-bit only - sub-seconds will overflow int32 */
		case TIME_SCALE_MSECS: case TIME_SCALE_USECS:
			RETURN_LONG(CONVERT_TIMEVAL_TO_LONG(tv, scale));

		/* timeval only has usec precision, emulate nsecs */
		case TIME_SCALE_NSECS:
			RETURN_LONG(CONVERT_TIMEVAL_TO_LONG(tv, TIME_SCALE_USECS) * 1000);
#endif

		default: {
			double result = CONVERT_TIMEVAL_TO_DOUBLE(tv, scale);

			if (result <= ZEND_LONG_MAX) {
				RETURN_LONG((zend_long)result);
			}

			RETURN_DOUBLE(floor(result));
		}
	}
}
/* }}} */

/* {{{ proto array gettimeofday([bool get_as_float])
   Returns the current time as array */
PHP_FUNCTION(gettimeofday)
{
	zend_bool get_as_float = 0;
	struct timeval tv = {0};
	timelib_time_offset *offset;

	ZEND_PARSE_PARAMETERS_START(0, 1)
		Z_PARAM_OPTIONAL
		Z_PARAM_BOOL(get_as_float)
	ZEND_PARSE_PARAMETERS_END();

	if (UNEXPECTED(gettimeofday(&tv, NULL) != SUCCESS)) {
		RETURN_FALSE;
	}

	if (get_as_float) {
		RETURN_DOUBLE(CONVERT_TIMEVAL_TO_DOUBLE(tv, 1));
	}

	offset = timelib_get_time_zone_info(tv.tv_sec, get_timezone_info());

	array_init(return_value);
	add_assoc_long(return_value, "sec", tv.tv_sec);
	add_assoc_long(return_value, "usec", tv.tv_usec);

	add_assoc_long(return_value, "minuteswest", -offset->offset / SEC_IN_MIN);
	add_assoc_long(return_value, "dsttime", offset->is_dst);

	timelib_time_offset_dtor(offset);
}
#endif
/* }}} */

#ifdef HAVE_GETRUSAGE
/* {{{ proto array getrusage([int who])
   Returns an array of usage statistics */
PHP_FUNCTION(getrusage)
{
	struct rusage usg;
	zend_long pwho = 0;
	int who = RUSAGE_SELF;

	ZEND_PARSE_PARAMETERS_START(0, 1)
		Z_PARAM_OPTIONAL
		Z_PARAM_LONG(pwho)
	ZEND_PARSE_PARAMETERS_END();

	if (pwho == 1) {
		who = RUSAGE_CHILDREN;
	}

	memset(&usg, 0, sizeof(struct rusage));

	if (getrusage(who, &usg) == -1) {
		RETURN_FALSE;
	}

	array_init(return_value);

#define PHP_RUSAGE_PARA(a) \
		add_assoc_long(return_value, #a, usg.a)

#ifdef PHP_WIN32 /* Windows only implements a limited amount of fields from the rusage struct */
	PHP_RUSAGE_PARA(ru_majflt);
	PHP_RUSAGE_PARA(ru_maxrss);
#elif !defined(_OSD_POSIX)
	PHP_RUSAGE_PARA(ru_oublock);
	PHP_RUSAGE_PARA(ru_inblock);
	PHP_RUSAGE_PARA(ru_msgsnd);
	PHP_RUSAGE_PARA(ru_msgrcv);
	PHP_RUSAGE_PARA(ru_maxrss);
	PHP_RUSAGE_PARA(ru_ixrss);
	PHP_RUSAGE_PARA(ru_idrss);
	PHP_RUSAGE_PARA(ru_minflt);
	PHP_RUSAGE_PARA(ru_majflt);
	PHP_RUSAGE_PARA(ru_nsignals);
	PHP_RUSAGE_PARA(ru_nvcsw);
	PHP_RUSAGE_PARA(ru_nivcsw);
	PHP_RUSAGE_PARA(ru_nswap);
#endif /*_OSD_POSIX*/
	PHP_RUSAGE_PARA(ru_utime.tv_usec);
	PHP_RUSAGE_PARA(ru_utime.tv_sec);
	PHP_RUSAGE_PARA(ru_stime.tv_usec);
	PHP_RUSAGE_PARA(ru_stime.tv_sec);

#undef PHP_RUSAGE_PARA
}
#endif /* HAVE_GETRUSAGE */

/* }}} */

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: sw=4 ts=4 fdm=marker
 * vim<600: sw=4 ts=4
 */
