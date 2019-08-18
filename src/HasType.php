<?php

namespace Monomelodies\Reflex;

use Closure;

trait HasType
{
    /**
     * Shorthand method.
     *
     * @return string
     */
    public function getNormalisedType() : string
    {
        return $this->getType()->getName();
    }
}

