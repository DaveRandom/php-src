--TEST--
Test opendir() function : usage variations - unexpected value for 'context' argument
--FILE--
<?php

/*
 * Prototype  : mixed opendir(string $path[, resource $context])
 * Description: Open a directory and return a dir_handle
 * Source code: ext/standard/dir.c
 */

/*
 * Passing invalid values to 'context' argument of opendir() and see that
 * the function outputs proper warning messages wherever expected.
 */

echo "*** Testing opendir() : unexpected values for \$context argument ***\n";

// create the temporary directory
$directory = __DIR__ . "/opendir_variation2";
mkdir($directory);

// unexpected values to be passed to $context argument
$unexpected_values = array(
    1 => 1,            // int
    2 => 1.5,          // float
    3 => true,         // bool
    4 => 'string',     // string
    5 => new stdClass, // object
);

// loop through each element of $unexpected_values to check the behavior of opendir()
foreach ($unexpected_values as $it => $value) {
    echo "\n-- Iteration $it --";
    var_dump($dh = opendir($directory, $value));
    if ($dh) {
        closedir($dh);
    }
}

?>
===DONE===
--CLEAN--
<?php

$directory = __DIR__ . "/opendir_variation2";
rmdir($directory);

?>
--EXPECTF--
*** Testing opendir() : unexpected values for $context argument ***

-- Iteration 1 --
Warning: opendir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 2 --
Warning: opendir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 3 --
Warning: opendir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 4 --
Warning: opendir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 5 --
Warning: opendir(): stream context must be a resource or an array in %s on line %d
NULL
===DONE===
