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
 * Passing non resource values to 'context' argument of dir() and see
 * that the function outputs proper warning messages wherever expected.
 */

echo "*** Testing dir() : unexpected values for \$context argument ***\n";

// create the temporary directory
$file_path = dirname(__FILE__);
$directory = $file_path."/dir_variation2";
@mkdir($directory);

// get an unset variable
$unset_var = stream_context_create();
unset($unset_var);

class classA
{
  public $var;
  public function init() {
    $this->var = 10;
  }
}

// heredoc string
$heredoc = <<<EOT
hello world
EOT;

// unexpected values to be passed to $directory argument
$unexpected_values = array (
       // int data
/*1*/  0,
       1,
       12345,
       -2345,

       // float data
/*5*/  10.5,
       -10.5,
       12.3456789000e10,
       12.3456789000E-10,
       .5,

       // null data
/*10*/ NULL,
       null,

       // boolean data
/*12*/ true,
       false,
       TRUE,
       FALSE,

       // empty data
/*16*/ "",
       '',

       // string data
/*18*/ "string",
       'string',
       $heredoc,

       // object data
/*21*/ new classA(),

       // undefined data
/*22*/ @$undefined_var,

       // unset data
/*23*/ @$unset_var
);

// loop through various elements of $unexpected_values to check the behavior of dir()
$iterator = 1;
foreach( $unexpected_values as $unexpected_value ) {
  echo "\n-- Iteration $iterator --";
  var_dump( dir($directory, $unexpected_value) );
  $iterator++;
}

echo "Done";
?>
--CLEAN--
<?php
$file_path = dirname(__FILE__);
$directory = $file_path."/dir_variation2";

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

-- Iteration 6 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 7 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 8 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 9 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 10 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 11 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 12 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 13 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 14 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 15 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 16 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 17 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 18 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 19 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 20 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 21 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 22 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL

-- Iteration 23 --
Warning: dir(): stream context must be a resource or an array in %s on line %d
NULL
Done