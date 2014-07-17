--TEST--
Test dir() function : usage variations - unexpected value for 'context' argument
--FILE--
<?php

/*
 * Prototype  : object dir(string $directory[, resource $context])
 * Description: Directory class with properties, handle and class and methods read, rewind and close
 * Source code: ext/standard/dir.c
 */

/*
 * Passing invalid values to 'context' argument of dir() and see that
 * the function outputs proper warning messages wherever expected.
 */

echo "*** Testing dir() : unexpected values for \$context argument ***\n";

// create the temporary directory
$directory = __DIR__ . "/dir_variation2";
mkdir($directory);

// unexpected values to be passed to $context argument
$unexpected_values = array(
    1 => 1,            // int
    2 => 1.5,          // float
    3 => true,         // bool
    4 => 'string',     // string
    5 => new stdClass, // object
);

// loop through various elements of $unexpected_values to check the behavior of dir()
foreach ($unexpected_values as $it => $value) {
    echo "\n-- Iteration $it --";
    var_dump(dir($directory, $value));
}

?>
===DONE===
--CLEAN--
<?php

$directory = __DIR__ . "/dir_variation2";
rmdir($directory);

?>
--EXPECTF--
*** Testing dir() : unexpected values for $context argument ***

-- Iteration 1 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 2 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 3 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 4 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 5 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL
===DONE===
