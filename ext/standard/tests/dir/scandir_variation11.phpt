--TEST--
Test scandir() function : usage variations - valid values for 'context' argument
--FILE--
<?php

/*
 * Prototype  : array scandir(string $dir [, int $sorting_order [, resource $context]])
 * Description: List files & directories inside the specified path 
 * Source code: ext/standard/dir.c
 */

/*
 * Passing valid values to 'context' argument of scandir() and see that
 * the function outputs no warning messages.
 */

echo "*** Testing scandir() : valid values for \$context argument ***\n";

// create the temporary directory
$directory = __DIR__ . "/scandir_variation11";
mkdir($directory);

// valid values to be passed to $context argument
$opts = ['foo' => ['bar' => 'baz']];
$ctx = stream_context_create($opts);
$fp = fopen(__FILE__, 'r', false, $ctx);

$values = [
    1 => $ctx,  // stream context
    2 => $opts, // array
    3 => $fp,   // stream
];

// loop through each element of $values to check the behavior of scandir()
foreach ($values as $it => $value) {
    echo "\n-- Iteration $it --\n";
    var_dump(scandir($directory, SCANDIR_SORT_ASCENDING, $value));
}

?>
===DONE===
--CLEAN--
<?php

$directory = __DIR__ . "/scandir_variation11";
rmdir($directory);

?>
--EXPECTF--
*** Testing scandir() : valid values for $context argument ***

-- Iteration 1 --
array(2) {
  [0]=>
  string(1) "."
  [1]=>
  string(2) ".."
}

-- Iteration 2 --
array(2) {
  [0]=>
  string(1) "."
  [1]=>
  string(2) ".."
}

-- Iteration 3 --
array(2) {
  [0]=>
  string(1) "."
  [1]=>
  string(2) ".."
}
===DONE===
