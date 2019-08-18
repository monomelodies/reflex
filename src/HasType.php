<?php

namespace Monomelodies\Reflex;

use Closure;

trait HasType
{
    public function getNormalisedType() : string
    {
        return $this->getType()->getName();
    }
}

