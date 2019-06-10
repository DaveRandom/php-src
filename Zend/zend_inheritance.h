/*
   +----------------------------------------------------------------------+
   | Zend Engine                                                          |
   +----------------------------------------------------------------------+
   | Copyright (c) Zend Technologies Ltd. (http://www.zend.com)           |
   +----------------------------------------------------------------------+
   | This source file is subject to version 2.00 of the Zend license,     |
   | that is bundled with this package in the file LICENSE, and is        |
   | available through the world-wide-web at the following url:           |
   | http://www.zend.com/license/2_00.txt.                                |
   | If you did not receive a copy of the Zend license and are unable to  |
   | obtain it through the world-wide-web, please send a note to          |
   | license@zend.com so we can mail you a copy immediately.              |
   +----------------------------------------------------------------------+
   | Authors: Andi Gutmans <andi@php.net>                                 |
   |          Zeev Suraski <zeev@php.net>                                 |
   +----------------------------------------------------------------------+
*/

#ifndef ZEND_INHERITANCE_H
#define ZEND_INHERITANCE_H

#include "zend.h"

BEGIN_EXTERN_C()

ZEND_API void zend_do_implement_interface(zend_class_entry *ce, zend_class_entry *iface);
ZEND_API void zend_do_inheritance(zend_class_entry *ce, zend_class_entry *parent_ce);

ZEND_API void zend_do_link_class(zend_class_entry *ce, zend_class_entry *parent_ce);

/* Unresolved means that class declarations that are currently not available are needed to
 * determine whether the inheritance is valid or not. At runtime UNRESOLVED should be treated
 * as an ERROR. */
typedef enum {
    ZEND_INHERITANCE_UNRESOLVED = -1,
    ZEND_INHERITANCE_ERROR = 0,
    ZEND_INHERITANCE_SUCCESS = 1,
} zend_inheritance_status;

ZEND_API zend_inheritance_status zend_check_function_compatibility(const zend_function *fe, const zend_function *proto, zend_string **unresolved_class);
ZEND_API zend_bool zend_check_function_interface_implementation(zval *zfunc, zend_class_entry *ce);

void zend_verify_abstract_class(zend_class_entry *ce);
void zend_build_properties_info_table(zend_class_entry *ce);
zend_bool zend_can_early_bind(zend_class_entry *ce, zend_class_entry *parent_ce);

END_EXTERN_C()

#endif
