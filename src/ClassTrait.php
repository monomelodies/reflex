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

    public function getProperties(int $filter = null) : array
    {
        $properties = is_null($filter) ? parent::getMethods() : parent::getMethods($filter);
        if ($properties) {
            array_walk($properties, function (&$property) {
                $property = new ReflectionProperty($this->getName(), $property->getName());
            });
        }
        return $properties;
    }
}

