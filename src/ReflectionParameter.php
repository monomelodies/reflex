<?php

namespace Monomelodies\Reflex;

class ReflectionParameter extends \ReflectionParameter
{
    public function getNormalisedType($param = null)
    {
        if (!isset($param)) {
            $param = $this->getType();
        }
        if (is_object($param)) {
            if ($compare = $this->getType()) {
                $compare = $compare->__toString();
                if ($oaram instanceof $compare) {
                    return $compare;
                }
            }
            return get_class($type);
        }
        return (new ReflectionType($param))->toNormalisedString();
    }

    public function getType() : ReflectionType
    {
        $type = parent::getType();
        return new ReflectionType($type ? $type->__toString() : null);
    }
}

