<?php

namespace Monomelodies\Reflex;

use ReflectionMethod;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use DomainException;

class AnyCallable
{
    /**
     * Get a reflection for any callable.
     *
     * @param mixed $callable Anything callable. Note that this also can be an
     *  abstract method (e.g. on an interface).
     * @return Reflection
     */
    public static function reflect($callable) : ReflectionFunctionAbstract
    {
        if (is_array($callable) && isset($callable[0], $callable[1])) {
            return new ReflectionMethod($callable[0], $callable[1]);
        } elseif (is_callable($callable)) {
            return new ReflectionFunction($callable);
        }
        throw new DomainException("$callable isn't callable");
    }
}

