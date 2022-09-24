<?php

namespace Monomelodies\Reflex;

use Closure;

class ReflectionFunction extends \ReflectionFunction
{
    use FunctionTrait;
    use Doccomment;

    public function __construct(private Closure|string $function)
    {
        parent::__construct($function);
    }

    public function getParameters() : array
    {
        $parameters = parent::getParameters();
        array_walk($parameters, function (&$parameter) {
            $parameter = new ReflectionParameter($this->function, $parameter->getName());
        });
        return $parameters;
    }
}

