--TEST--
Test << operator : various numbers as strings
--SKIPIF--
<?php
if (PHP_INT_SIZE != 4) die("skip this test is for 32bit platform only");
if ((65<<65)==0) die("skip this test is for Intel only");
?>
--FILE--
<?php

$strVals = array(
   "0","65","-44", "1.2", "-7.7", "abc", "123abc", "123e5", "123e5xyz", " 123abc", "123 abc", "123abc ", "3.4a",
   "a5.9"
);

error_reporting(E_ERROR);

foreach ($strVals as $strVal) {
   foreach($strVals as $otherVal) {
	   echo "--- testing: '$strVal' << '$otherVal' ---\n";   
      var_dump(bin2hex($strVal<<$otherVal));
   }
}
   
?>
===DONE===
--EXPECTF--
--- testing: '0' << '0' ---
string(2) "30"
--- testing: '0' << '65' ---
string(2) "00"
--- testing: '0' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(2) "30"
--- testing: '0' << '1.2' ---
string(2) "60"
--- testing: '0' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(2) "30"
--- testing: '0' << 'abc' ---
string(2) "30"
--- testing: '0' << '123abc' ---
string(2) "00"
--- testing: '0' << '123e5' ---
string(2) "00"
--- testing: '0' << '123e5xyz' ---
string(2) "00"
--- testing: '0' << ' 123abc' ---
string(2) "00"
--- testing: '0' << '123 abc' ---
string(2) "00"
--- testing: '0' << '123abc ' ---
string(2) "00"
--- testing: '0' << '3.4a' ---
string(2) "80"
--- testing: '0' << 'a5.9' ---
string(2) "30"
--- testing: '65' << '0' ---
string(4) "3635"
--- testing: '65' << '65' ---
string(4) "0000"
--- testing: '65' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(4) "3635"
--- testing: '65' << '1.2' ---
string(4) "6c6a"
--- testing: '65' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(4) "3635"
--- testing: '65' << 'abc' ---
string(4) "3635"
--- testing: '65' << '123abc' ---
string(4) "0000"
--- testing: '65' << '123e5' ---
string(4) "0000"
--- testing: '65' << '123e5xyz' ---
string(4) "0000"
--- testing: '65' << ' 123abc' ---
string(4) "0000"
--- testing: '65' << '123 abc' ---
string(4) "0000"
--- testing: '65' << '123abc ' ---
string(4) "0000"
--- testing: '65' << '3.4a' ---
string(4) "b1a8"
--- testing: '65' << 'a5.9' ---
string(4) "3635"
--- testing: '-44' << '0' ---
string(6) "2d3434"
--- testing: '-44' << '65' ---
string(6) "000000"
--- testing: '-44' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(6) "2d3434"
--- testing: '-44' << '1.2' ---
string(6) "5a6868"
--- testing: '-44' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(6) "2d3434"
--- testing: '-44' << 'abc' ---
string(6) "2d3434"
--- testing: '-44' << '123abc' ---
string(6) "000000"
--- testing: '-44' << '123e5' ---
string(6) "000000"
--- testing: '-44' << '123e5xyz' ---
string(6) "000000"
--- testing: '-44' << ' 123abc' ---
string(6) "000000"
--- testing: '-44' << '123 abc' ---
string(6) "000000"
--- testing: '-44' << '123abc ' ---
string(6) "000000"
--- testing: '-44' << '3.4a' ---
string(6) "69a1a0"
--- testing: '-44' << 'a5.9' ---
string(6) "2d3434"
--- testing: '1.2' << '0' ---
string(6) "312e32"
--- testing: '1.2' << '65' ---
string(6) "000000"
--- testing: '1.2' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(6) "312e32"
--- testing: '1.2' << '1.2' ---
string(6) "625c64"
--- testing: '1.2' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(6) "312e32"
--- testing: '1.2' << 'abc' ---
string(6) "312e32"
--- testing: '1.2' << '123abc' ---
string(6) "000000"
--- testing: '1.2' << '123e5' ---
string(6) "000000"
--- testing: '1.2' << '123e5xyz' ---
string(6) "000000"
--- testing: '1.2' << ' 123abc' ---
string(6) "000000"
--- testing: '1.2' << '123 abc' ---
string(6) "000000"
--- testing: '1.2' << '123abc ' ---
string(6) "000000"
--- testing: '1.2' << '3.4a' ---
string(6) "897190"
--- testing: '1.2' << 'a5.9' ---
string(6) "312e32"
--- testing: '-7.7' << '0' ---
string(8) "2d372e37"
--- testing: '-7.7' << '65' ---
string(8) "00000000"
--- testing: '-7.7' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(8) "2d372e37"
--- testing: '-7.7' << '1.2' ---
string(8) "5a6e5c6e"
--- testing: '-7.7' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(8) "2d372e37"
--- testing: '-7.7' << 'abc' ---
string(8) "2d372e37"
--- testing: '-7.7' << '123abc' ---
string(8) "00000000"
--- testing: '-7.7' << '123e5' ---
string(8) "00000000"
--- testing: '-7.7' << '123e5xyz' ---
string(8) "00000000"
--- testing: '-7.7' << ' 123abc' ---
string(8) "00000000"
--- testing: '-7.7' << '123 abc' ---
string(8) "00000000"
--- testing: '-7.7' << '123abc ' ---
string(8) "00000000"
--- testing: '-7.7' << '3.4a' ---
string(8) "69b971b8"
--- testing: '-7.7' << 'a5.9' ---
string(8) "2d372e37"
--- testing: 'abc' << '0' ---
string(6) "616263"
--- testing: 'abc' << '65' ---
string(6) "000000"
--- testing: 'abc' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(6) "616263"
--- testing: 'abc' << '1.2' ---
string(6) "c2c4c6"
--- testing: 'abc' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(6) "616263"
--- testing: 'abc' << 'abc' ---
string(6) "616263"
--- testing: 'abc' << '123abc' ---
string(6) "000000"
--- testing: 'abc' << '123e5' ---
string(6) "000000"
--- testing: 'abc' << '123e5xyz' ---
string(6) "000000"
--- testing: 'abc' << ' 123abc' ---
string(6) "000000"
--- testing: 'abc' << '123 abc' ---
string(6) "000000"
--- testing: 'abc' << '123abc ' ---
string(6) "000000"
--- testing: 'abc' << '3.4a' ---
string(6) "0b1318"
--- testing: 'abc' << 'a5.9' ---
string(6) "616263"
--- testing: '123abc' << '0' ---
string(12) "313233616263"
--- testing: '123abc' << '65' ---
string(12) "000000000000"
--- testing: '123abc' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(12) "313233616263"
--- testing: '123abc' << '1.2' ---
string(12) "626466c2c4c6"
--- testing: '123abc' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(12) "313233616263"
--- testing: '123abc' << 'abc' ---
string(12) "313233616263"
--- testing: '123abc' << '123abc' ---
string(12) "000000000000"
--- testing: '123abc' << '123e5' ---
string(12) "000000000000"
--- testing: '123abc' << '123e5xyz' ---
string(12) "000000000000"
--- testing: '123abc' << ' 123abc' ---
string(12) "000000000000"
--- testing: '123abc' << '123 abc' ---
string(12) "000000000000"
--- testing: '123abc' << '123abc ' ---
string(12) "000000000000"
--- testing: '123abc' << '3.4a' ---
string(12) "89919b0b1318"
--- testing: '123abc' << 'a5.9' ---
string(12) "313233616263"
--- testing: '123e5' << '0' ---
string(10) "3132336535"
--- testing: '123e5' << '65' ---
string(10) "0000000000"
--- testing: '123e5' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(10) "3132336535"
--- testing: '123e5' << '1.2' ---
string(10) "626466ca6a"
--- testing: '123e5' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(10) "3132336535"
--- testing: '123e5' << 'abc' ---
string(10) "3132336535"
--- testing: '123e5' << '123abc' ---
string(10) "0000000000"
--- testing: '123e5' << '123e5' ---
string(10) "0000000000"
--- testing: '123e5' << '123e5xyz' ---
string(10) "0000000000"
--- testing: '123e5' << ' 123abc' ---
string(10) "0000000000"
--- testing: '123e5' << '123 abc' ---
string(10) "0000000000"
--- testing: '123e5' << '123abc ' ---
string(10) "0000000000"
--- testing: '123e5' << '3.4a' ---
string(10) "89919b29a8"
--- testing: '123e5' << 'a5.9' ---
string(10) "3132336535"
--- testing: '123e5xyz' << '0' ---
string(16) "313233653578797a"
--- testing: '123e5xyz' << '65' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(16) "313233653578797a"
--- testing: '123e5xyz' << '1.2' ---
string(16) "626466ca6af0f2f4"
--- testing: '123e5xyz' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(16) "313233653578797a"
--- testing: '123e5xyz' << 'abc' ---
string(16) "313233653578797a"
--- testing: '123e5xyz' << '123abc' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << '123e5' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << '123e5xyz' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << ' 123abc' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << '123 abc' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << '123abc ' ---
string(16) "0000000000000000"
--- testing: '123e5xyz' << '3.4a' ---
string(16) "89919b29abc3cbd0"
--- testing: '123e5xyz' << 'a5.9' ---
string(16) "313233653578797a"
--- testing: ' 123abc' << '0' ---
string(14) "20313233616263"
--- testing: ' 123abc' << '65' ---
string(14) "00000000000000"
--- testing: ' 123abc' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(14) "20313233616263"
--- testing: ' 123abc' << '1.2' ---
string(14) "40626466c2c4c6"
--- testing: ' 123abc' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(14) "20313233616263"
--- testing: ' 123abc' << 'abc' ---
string(14) "20313233616263"
--- testing: ' 123abc' << '123abc' ---
string(14) "00000000000000"
--- testing: ' 123abc' << '123e5' ---
string(14) "00000000000000"
--- testing: ' 123abc' << '123e5xyz' ---
string(14) "00000000000000"
--- testing: ' 123abc' << ' 123abc' ---
string(14) "00000000000000"
--- testing: ' 123abc' << '123 abc' ---
string(14) "00000000000000"
--- testing: ' 123abc' << '123abc ' ---
string(14) "00000000000000"
--- testing: ' 123abc' << '3.4a' ---
string(14) "0189919b0b1318"
--- testing: ' 123abc' << 'a5.9' ---
string(14) "20313233616263"
--- testing: '123 abc' << '0' ---
string(14) "31323320616263"
--- testing: '123 abc' << '65' ---
string(14) "00000000000000"
--- testing: '123 abc' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(14) "31323320616263"
--- testing: '123 abc' << '1.2' ---
string(14) "62646640c2c4c6"
--- testing: '123 abc' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(14) "31323320616263"
--- testing: '123 abc' << 'abc' ---
string(14) "31323320616263"
--- testing: '123 abc' << '123abc' ---
string(14) "00000000000000"
--- testing: '123 abc' << '123e5' ---
string(14) "00000000000000"
--- testing: '123 abc' << '123e5xyz' ---
string(14) "00000000000000"
--- testing: '123 abc' << ' 123abc' ---
string(14) "00000000000000"
--- testing: '123 abc' << '123 abc' ---
string(14) "00000000000000"
--- testing: '123 abc' << '123abc ' ---
string(14) "00000000000000"
--- testing: '123 abc' << '3.4a' ---
string(14) "899199030b1318"
--- testing: '123 abc' << 'a5.9' ---
string(14) "31323320616263"
--- testing: '123abc ' << '0' ---
string(14) "31323361626320"
--- testing: '123abc ' << '65' ---
string(14) "00000000000000"
--- testing: '123abc ' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(14) "31323361626320"
--- testing: '123abc ' << '1.2' ---
string(14) "626466c2c4c640"
--- testing: '123abc ' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(14) "31323361626320"
--- testing: '123abc ' << 'abc' ---
string(14) "31323361626320"
--- testing: '123abc ' << '123abc' ---
string(14) "00000000000000"
--- testing: '123abc ' << '123e5' ---
string(14) "00000000000000"
--- testing: '123abc ' << '123e5xyz' ---
string(14) "00000000000000"
--- testing: '123abc ' << ' 123abc' ---
string(14) "00000000000000"
--- testing: '123abc ' << '123 abc' ---
string(14) "00000000000000"
--- testing: '123abc ' << '123abc ' ---
string(14) "00000000000000"
--- testing: '123abc ' << '3.4a' ---
string(14) "89919b0b131900"
--- testing: '123abc ' << 'a5.9' ---
string(14) "31323361626320"
--- testing: '3.4a' << '0' ---
string(8) "332e3461"
--- testing: '3.4a' << '65' ---
string(8) "00000000"
--- testing: '3.4a' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(8) "332e3461"
--- testing: '3.4a' << '1.2' ---
string(8) "665c68c2"
--- testing: '3.4a' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(8) "332e3461"
--- testing: '3.4a' << 'abc' ---
string(8) "332e3461"
--- testing: '3.4a' << '123abc' ---
string(8) "00000000"
--- testing: '3.4a' << '123e5' ---
string(8) "00000000"
--- testing: '3.4a' << '123e5xyz' ---
string(8) "00000000"
--- testing: '3.4a' << ' 123abc' ---
string(8) "00000000"
--- testing: '3.4a' << '123 abc' ---
string(8) "00000000"
--- testing: '3.4a' << '123abc ' ---
string(8) "00000000"
--- testing: '3.4a' << '3.4a' ---
string(8) "9971a308"
--- testing: '3.4a' << 'a5.9' ---
string(8) "332e3461"
--- testing: 'a5.9' << '0' ---
string(8) "61352e39"
--- testing: 'a5.9' << '65' ---
string(8) "00000000"
--- testing: 'a5.9' << '-44' ---

Notice: Invalid right operand for left shift operation: -44 in %s on line %d
string(8) "61352e39"
--- testing: 'a5.9' << '1.2' ---
string(8) "c26a5c72"
--- testing: 'a5.9' << '-7.7' ---

Notice: Invalid right operand for left shift operation: -7 in %s on line %d
string(8) "61352e39"
--- testing: 'a5.9' << 'abc' ---
string(8) "61352e39"
--- testing: 'a5.9' << '123abc' ---
string(8) "00000000"
--- testing: 'a5.9' << '123e5' ---
string(8) "00000000"
--- testing: 'a5.9' << '123e5xyz' ---
string(8) "00000000"
--- testing: 'a5.9' << ' 123abc' ---
string(8) "00000000"
--- testing: 'a5.9' << '123 abc' ---
string(8) "00000000"
--- testing: 'a5.9' << '123abc ' ---
string(8) "00000000"
--- testing: 'a5.9' << '3.4a' ---
string(8) "09a971c8"
--- testing: 'a5.9' << 'a5.9' ---
string(8) "61352e39"
===DONE===
