--TEST--
Test dir() function : usage variations - valid values for 'context' argument
--FILE--
<?php

/*
 * Prototype  : object dir(string $directory[, resource $context])
 * Description: Directory class with properties, handle and class and methods read, rewind and close
 * Source code: ext/standard/dir.c
 */

/*
 * Passing valid values to 'context' argument of dir() and see that
 * the function outputs no warning messages.
 */

echo "*** Testing dir() : valid values for \$context argument ***\n";

// create the temporary directory
$directory = __DIR__ . "/dir_variation10";
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

// loop through each element of $values to check the behavior of dir()
foreach ($values as $it => $value) {
    echo "\n-- Iteration $it --\n";
    var_dump(dir($directory, $value));
}

?>
===DONE===
--CLEAN--
<?php

$directory = __DIR__ . "/dir_variation10";
rmdir($directory);

?>
--EXPECTF--
*** Testing dir() : valid values for $context argument ***

-- Iteration 1 --
object(Directory)#%d (%d) {
  ["path"]=>
  string(%d) "%s"
  ["handle"]=>
  resource(%d) of type (stream)
}

-- Iteration 2 --
object(Directory)#%d (%d) {
  ["path"]=>
  string(%d) "%s"
  ["handle"]=>
  resource(%d) of type (stream)
}

-- Iteration 3 --
object(Directory)#%d (%d) {
  ["path"]=>
  string(%d) "%s"
  ["handle"]=>
  resource(%d) of type (stream)
}
===DONE===
