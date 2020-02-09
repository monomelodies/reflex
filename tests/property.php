<?php

/** Tests for ReflectionProperty */
return function () : Generator {
    /** We can get the classname of the defining file */
    yield function () {
        $reflection = new Monomelodies\Reflex\ReflectionObject(new class {
            public $foo;
        });
        $property = $reflection->getProperty('foo');
        assert($property->getFileName() === __FILE__);
        assert($property->getLine() === 8);
    };
};

