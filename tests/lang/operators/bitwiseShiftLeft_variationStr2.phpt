--TEST--
Test << operator : numbers as strings, simple
--FILE--
<?php

var_dump("12" << 0);
var_dump("34" << 1);
var_dump(bin2hex("56" << 2));

?>
===DONE===
--EXPECT--
string(2) "12"
string(2) "fh"
string(4) "d4d8"
===DONE===
