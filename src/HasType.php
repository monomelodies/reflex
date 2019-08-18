<?php

namespace Monomelodies\Reflex;

use Closure;

trait HasType
{
    /**
     * Shorthand method.
     *
     * @return string|null
     */
    public function getNormalisedType() :? string
    {
        if ($type = $this->getType()) {
            return $type->getName();
        } else {
            return null;
        }
    }
}

