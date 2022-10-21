<?php

namespace Monomelodies\Reflex;

use ReflectionType;
use ReflectionNamedType;
use ReflectionUnionType;
use ReflectionIntersectionType;

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
        $types = [];
        array_walk($params, function (ReflectionParameter $param) use (&$types) {
            $types[] = $param->getType();
        });
        $options = $this->buildOptions(...$types);
        $last = array_pop($params);
        if ($last->isOptional() && !$last->isVariadic()) {
            $options = array_merge($options, $this->getPossibleCalls(...$params));
        }
        return array_unique($options, SORT_REGULAR);
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
     * Internal method to recursively build an list of ways this function
     * might be invoked.
     *
     * @param null|ReflectionType ...$types
     * @return array
     */
    private function buildOptions(?ReflectionType ...$types) : array
    {
        $options = [];
        $params = [];
        foreach ($types as $i => $type) {
            if ($type === null) {
                $type = 'null';
            } else {
                if ($type->allowsNull()) {
                    $copyTypes = array_values($types);
                    $copyTypes[$i] = null;
                    $options = array_merge($options, $this->buildOptions(...$copyTypes));
                }
                if ($type instanceof ReflectionNamedType) {
                    $type = "$type";
                    if (substr($type, 0, 1) == '?') {
                        $type = substr($type, 1);
                    }
                } elseif ($type instanceof ReflectionIntersectionType) {
                    $type = $type->getTypes()[0]->__toString();
                } elseif ($type instanceof ReflectionUnionType) {
                    $subtypes = $type->getTypes();
                    $type = array_shift($subtypes)->__toString();
                    foreach ($subtypes as $subtype) {
                        $copyTypes = array_values($types);
                        $copyTypes[$i] = $subtype;
                        $options = array_merge($options, $this->buildOptions(...$copyTypes));
                    }
                }
            }
            $params[] = $type;
        }
        while (end($params) === 'null') {
            array_pop($params);
        }
        $options[] = $params;
        return $options;
    }
}

