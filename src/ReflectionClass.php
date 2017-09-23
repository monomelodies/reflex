<?php

namespace Monomelodies\Reflex;

class ReflectionClass extends \ReflectionClass
{
    public function getMethods($filter = null) : array
    {
        // Note: passing a null filter returns an empty array.
        // Seems to be a PHP bug.
        $methods = is_null($filter) ? parent::getMethods() : parent::getMethods($filter);
        array_map($methods, function (&$methods) {
            $method = new ReflectionFunction([$this->getName(), $method->getName()]);
        });
        return $methods;
    }
}

