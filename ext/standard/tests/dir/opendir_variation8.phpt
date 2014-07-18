--TEST--
Test opendir() function : usage variations - valid values for 'context' argument
--FILE--
<?php

/*
 * Prototype  : mixed opendir(string $path[, resource $context])
 * Description: Open a directory and return a dir_handle
 * Source code: ext/standard/dir.c
 */

/*
 * Passing valid values to 'context' argument of opendir() and see that
 * the function outputs no warning messages.
 */

echo "*** Testing opendir() : valid values for \$context argument ***\n";

// create the temporary directory
$directory = __DIR__ . "/opendir_variation8";
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

// loop through each element of $values to check the behavior of opendir()
foreach ($values as $it => $value) {
    echo "\n-- Iteration $it --\n";
    var_dump($dh = opendir($directory, $value));
    if ($dh) {
        closedir($dh);
    }
}

?>
===DONE===
--CLEAN--
<?php

$directory = __DIR__ . "/opendir_variation8";
rmdir($directory);

?>
--EXPECTF--
*** Testing opendir() : valid values for $context argument ***

-- Iteration 1 --
resource(%d) of type (stream)

-- Iteration 2 --
resource(%d) of type (stream)

-- Iteration 3 --
resource(%d) of type (stream)
===DONE===
