<?php

return function () : Generator {
    /** Tests for Reflex's ReflectionParameter */
    yield function () : Generator {
        $reflection = new Monomelodies\Reflex\ReflectionParameter([Tests\Foo::class, 'bar'], 'string');
        /** getType returns a wrapped instance of ReflectionType */
        yield function () use ($reflection) {
            $type = $reflection->getType();
            assert($type instanceof ReflectionType);
        };
    };
};

