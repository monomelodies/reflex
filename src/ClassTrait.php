<?php

namespace Monomelodies\Reflex;

trait ClassTrait
{
    public function getMethods($filter = null) : array
    {
        // Note: passing a null filter returns an empty array.
        // Seems to be a PHP bug.
        $methods = is_null($filter) ? parent::getMethods() : parent::getMethods($filter);
        if ($methods) {
            array_walk($methods, function (&$method) {
                $method = new ReflectionMethod($this->getName(), $method->getName());
            });
        }
        return $methods;
    }
}

