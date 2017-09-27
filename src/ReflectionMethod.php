<?php

namespace Monomelodies\Reflex;

class ReflectionMethod extends \ReflectionMethod
{
    use FunctionTrait;

    public function getParameters() : array
    {
        $parameters = parent::getParameters();
        array_walk($parameters, function (&$parameter) {
            $parameter = new ReflectionParameter([$this->getDeclaringClass()->getName(), $this->getName()], $parameter->getName());
        });
        return $parameters;
    }

    public function getDeclaringClass() : ReflectionClass
    {
        $class = parent::getDeclaringClass();
        return new ReflectionClass($class->getName());
    }
}

