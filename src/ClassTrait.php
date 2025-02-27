<?php

namespace Monomelodies\Reflex;

trait ClassTrait
{
    /**
     * @param int|null $filter
     * @return Monomelodies\Reflex\ReflectionMethod[]
     */
    public function getMethods(?int $filter = null) : array
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

    /**
     * @param string $name
     * @return Monomelodies\Reflex\ReflectionMethod
     * @throws ReflectionException
     */
    public function getMethod($name) : ReflectionMethod
    {
        $method = parent::getMethod($name);
        return new ReflectionMethod($this->getName(), $method->getName());
    }

    /**
     * @param int|null $filter
     * @return Monomelodies\Reflex\ReflectionProperty[]
     */
    public function getProperties(?int $filter = null) : array
    {
        $properties = is_null($filter) ? parent::getProperties() : parent::getProperties($filter);
        if ($properties) {
            array_walk($properties, function (&$property) {
                $property = new ReflectionProperty($this->getName(), $property->getName());
            });
        }
        return $properties;
    }

    /**
     * @param string $name
     * @return Monomelodies\Reflex\ReflectionProperty
     * @throws ReflectionException
     */
    public function getProperty($name) : ReflectionProperty
    {
        $property = parent::getProperty($name);
        return new ReflectionProperty($this->getName(), $property->getName());
    }
}

