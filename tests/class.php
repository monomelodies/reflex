<?php

return function () : Generator {
    /** Tests for Reflex's ReflectionClass */
    yield function () : Generator {
        $reflection = new Monomelodies\Reflex\ReflectionClass(Tests\Foo::class);
        /** getMethods returns an array of wrapped reflection methds */
        yield function () use ($reflection) {
            $methods = $reflection->getMethods();
            assert($methods[0] instanceof Monomelodies\Reflex\ReflectionMethod);
        };
    };
};

