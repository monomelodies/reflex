<?php

namespace Monomelodies\Reflex;

class ReflectionType extends \ReflectionType
{
    public function toNormalisedString() : string
    {
        if (is_callable($type)) {
            return 'callable';
        }
        $type = gettype($type);
        switch ($type) {
            case 'integer': return 'int';
            case 'boolean': return 'bool';
            case 'double': return 'float';
            default: return $type;
        }
    }
}

