--TEST--
DateTime ZEND_ADD op -- dates
--CREDITS--
Daniel Convissor <danielc@php.net>
--FILE--
<?php

require 'examine_diff.inc';
define('PHPT_DATETIME_SHOW', PHPT_DATETIME_SHOW_ADD_OP);
require 'DateTime_data-dates.inc';

?>
--EXPECT--
test__7: ADD OP: 2009-01-07 00:00:00 EST + P+0Y0M7DT0H0M0S = **2009-01-14 00:00:00 EST**
test_years_positive__7_by_0_day: ADD OP: 2000-02-07 00:00:00 EST + P+7Y0M0DT0H0M0S = **2007-02-07 00:00:00 EST**
test_years_positive__7_by_1_day: ADD OP: 2000-02-07 00:00:00 EST + P+7Y0M1DT0H0M0S = **2007-02-08 00:00:00 EST**
test_years_positive__6_shy_1_day: ADD OP: 2000-02-07 00:00:00 EST + P+6Y11M30DT0H0M0S = **2007-02-06 00:00:00 EST**
test_years_positive__7_by_1_month: ADD OP: 2000-02-07 00:00:00 EST + P+7Y1M0DT0H0M0S = **2007-03-07 00:00:00 EST**
test_years_positive__6_shy_1_month: ADD OP: 2000-02-07 00:00:00 EST + P+6Y11M0DT0H0M0S = **2007-01-07 00:00:00 EST**
test_years_positive__7_by_1_month_split_newyear: ADD OP: 1999-12-07 00:00:00 EST + P+7Y1M0DT0H0M0S = **2007-01-07 00:00:00 EST**
test_years_positive__6_shy_1_month_split_newyear: ADD OP: 2000-01-07 00:00:00 EST + P+6Y11M0DT0H0M0S = **2006-12-07 00:00:00 EST**
test_negative__7: ADD OP: 2009-01-14 00:00:00 EST + P-0Y0M7DT0H0M0S = **2009-01-07 00:00:00 EST**
test_years_negative__7_by_0_day: ADD OP: 2007-02-07 00:00:00 EST + P-7Y0M0DT0H0M0S = **2000-02-07 00:00:00 EST**
test_years_negative__7_by_1_day: ADD OP: 2007-02-08 00:00:00 EST + P-7Y0M1DT0H0M0S = **2000-02-07 00:00:00 EST**
test_years_negative__6_shy_1_day: ADD OP: 2007-02-06 00:00:00 EST + P-6Y11M28DT0H0M0S = **2000-02-07 00:00:00 EST**
test_years_negative__7_by_1_month: ADD OP: 2007-03-07 00:00:00 EST + P-7Y1M0DT0H0M0S = **2000-02-07 00:00:00 EST**
test_years_negative__6_shy_1_month: ADD OP: 2007-01-07 00:00:00 EST + P-6Y11M0DT0H0M0S = **2000-02-07 00:00:00 EST**
test_years_negative__7_by_1_month_split_newyear: ADD OP: 2007-01-07 00:00:00 EST + P-7Y1M0DT0H0M0S = **1999-12-07 00:00:00 EST**
test_years_negative__6_shy_1_month_split_newyear: ADD OP: 2006-12-07 00:00:00 EST + P-6Y11M0DT0H0M0S = **2000-01-07 00:00:00 EST**
