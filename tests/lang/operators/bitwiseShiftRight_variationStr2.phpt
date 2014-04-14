--TEST--
Test >> operator : numbers as strings, simple
--FILE--
<?php

error_reporting(E_ERROR);

var_dump(bin2hex("12" >> 0));
var_dump(bin2hex("34" >> 1));
var_dump(bin2hex("56" >> 2));

?>
===DONE===
--EXPECT--
string(4) "3132"
string(4) "199a"
string(4) "0d4d"
===DONE===
