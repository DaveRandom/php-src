--TEST--
Valid function interface implementations
--FILE--
<?php

function interface Foo(int $int, string $string);

function test(Foo $foo) {}

function f(bool $bool) {}
class C {
    function __invoke(bool $bool) {}
    function i(bool $bool) {}
    static function s(bool $bool) {}
}

$tests = [
    'function '        => 'f',
    'instance method'  => [new C, 'i'],
    'static method'    => 'C::s',
    'closure'          => function(bool $bool) {},
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
function fail
instance method fail
static method fail
closure fail
invokable object fail
done
