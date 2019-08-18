<?php

namespace Monomelodies\Reflex;

class ReflectionFunction extends \ReflectionFunction
{
    use FunctionTrait;
    use Doccomment;

    public function getParameters() : array
    {
        $parameters = parent::getParameters();
        array_walk($parameters, function (&$parameter) {
            $parameter = new ReflectionParameter($this->getName(), $parameter->getName());
        });
        return $parameters;
    }
}

