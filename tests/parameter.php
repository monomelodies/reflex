<?php

return function () : Generator {
    /** Tests for Reflex's ReflectionParameter */
    yield function () : Generator {
        $reflection = new Monomelodies\Reflex\ReflectionParameter([Tests\Foo::class, 'bar'], 'string');
        /** getMethods returns an array of wrapped reflection methds */
        yield function () use ($reflection) {
            $type = $reflection->getType();
            assert($type instanceof Monomelodies\Reflex\ReflectionType);
        };
    };
};

