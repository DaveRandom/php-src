--TEST--
Valid function interface implementations
--FILE--
<?php

function interface Foo(int $int, string $string);

function test(Foo $foo) {}

function f(int $int, string $string) {}
class C {
    function __invoke(int $int, string $string) {}
    function i(int $int, string $string) {}
    static function s(int $int, string $string) {}
}

$tests = [
    'function '        => 'f',
    'instance method'  => [new C, 'i'],
    'static method'    => 'C::s',
    'closure'          => function(int $int, string $string) {},
    'invokable object' => new C,
];

foreach ($tests as $type => $test) {
    try {
        test($test);
        echo "{$type} pass\n";
    } catch (TypeError $e) {
        echo "{$type} fail\n";
    }
}

echo "done";
--EXPECT--
function pass
instance method pass
static method pass
closure pass
invokable object pass
done
