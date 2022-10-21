<?php

namespace Monomelodies\Reflex;

use ReflectionNamedType;
use ReflectionUnionType;
use ReflectionIntersectionType;

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
            if ($type instanceof ReflectionNamedType) {
                return $type->getName();
            }
            if ($type instanceof ReflectionUnionType) {
                return implode('|', $type->getTypes());
            }
            if ($type instanceof ReflectionIntersectionType) {
                return implode('&', $type->getTypes());
            }
        }
        return null;
    }
}

