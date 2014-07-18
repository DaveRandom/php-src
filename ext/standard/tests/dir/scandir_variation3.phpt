--TEST--
Test scandir() function : usage variations - unexpected value for 'context' argument
--FILE--
<?php

/*
 * Prototype  : array scandir(string $dir [, int $sorting_order [, resource $context]])
 * Description: List files & directories inside the specified path 
 * Source code: ext/standard/dir.c
 */

/*
 * Passing invalid values to 'context' argument of scandir() and see that
 * the function outputs proper warning messages wherever expected.
 */

echo "*** Testing scandir() : unexpected values for \$context argument ***\n";

// create the temporary directory
$directory = __DIR__ . "/scandir_variation3";
mkdir($directory);

// unexpected values to be passed to $context argument
$values = [
    1 => 1,            // int
    2 => 1.5,          // float
    3 => true,         // bool
    4 => 'string',     // string
    5 => new stdClass, // object
];

// loop through each element of $values to check the behavior of scandir()
foreach ($values as $it => $value) {
    echo "\n-- Iteration $it --";
    var_dump(scandir($directory, SCANDIR_SORT_ASCENDING, $value));
};

?>
===DONE===
--CLEAN--
<?php

$directory = __DIR__ . "/scandir_variation3";
rmdir($directory);

?>
--EXPECTF--
*** Testing scandir() : unexpected values for $context argument ***

-- Iteration 1 --
Warning: scandir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 2 --
Warning: scandir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 3 --
Warning: scandir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 4 --
Warning: scandir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 5 --
Warning: scandir(): stream context must be a resource or an array in %s on line %d
NULL
===DONE===
