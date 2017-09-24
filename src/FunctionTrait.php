<?php

namespace Monomelodies\Reflex;

use zpt\anno\Annotations;

trait FunctionTrait
{
    /**
     * Return an array of all possible combinations of variable types.
     *
     * @param ReflectionParameter ...$params Zero or more reflection parameters.
     * @return array Array of array of possible combination of parameter types
     *  this method accepts.
     */
    public function getPossibleCalls(ReflectionParameter ...$params) : array
    {
        if (!count($params)) {
            return [[]];
        }
        $options = [];
        $opts = [];
        $annotations = new Annotations($this);
        foreach ($params as $i => $param) {
            if (!$param->hasType()) {
                if (isset($annotations['param'][$i])) {
                    if (is_string($annotations['param']) && $i === 0) {
                        $opts[] = $this->extractTypeFromAnnotation($annotations['param']);
                    } else {
                        $opts[] = $this->extractTypeFromAnnotation($annotations['param'][$i]);
                    }
                } else {
                    $opts[] = 'mixed';
                }
            } else {
                $opts[] = $param->getType()->__toString();
            }
        }
        $options[] = $opts;
        $last = array_pop($params);
        if ($last->isOptional() && !$last->isVariadic()) {
            $options = array_merge($options, $this->getPossibleCalls($fn, ...$params));
        }
        return $options;
    }

    /**
     * Returns an array of all possible return types, as instances of
     * Monomelodies\Reflex\ReflectionType.
     *
     * @return array
     */
    public function getPossibleReturnTypes() : array
    {
        $types = [];
        if ($this->hasReturnType()) {
            $types[] = $this->getReturnType();
            if ($types[0]->allowsNull()) {
                $types[] = null;
            }
        }
        return $types;
    }

    /**
     * Extract the type from the annotation.
     *
     * @param string $annotation
     * @return string
     */
    private function extractTypeFromAnnotation(string $annotation) : string
    {
        if (!preg_match('@^([\w\\|]+)\s@', $annotation, $match)) {
            return 'mixed';
        }
        return $match[1];
    }
}

