<?php

namespace Monomelodies\Reflex;

class ReflectionParameter extends \ReflectionParameter
{
    public function getNormalisedType($param = null) : string
    {
        if (!isset($param)) {
            $param = $this->getType();
        }
        if (is_object($param)) {
            if ($compare = $this->getType()) {
                $compare = $compare->__toString();
                if ($param instanceof $compare) {
                    return $compare;
                }
            }
            return get_class($param);
        }
        if (is_callable($param)) {
            return 'callable';
        }
        $type = gettype($param);
        switch ($type) {
            case 'integer': return 'int';
            case 'boolean': return 'bool';
            case 'double': return 'float';
            default: return $type;
        }
    }
}

