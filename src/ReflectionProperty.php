<?php

namespace Monomelodies\Reflex;

class ReflectionProperty extends \ReflectionProperty
{
    use Doccomment;
    use HasType;

    /**
     * Get the file in which this property was declared.
     */
    public function getFileName() : string
    {
        return $this->getDeclaringClass()->getFileName();
    }

    /**
     * Get the line where this property was declared.
     */
    public function getLine() : int
    {
        $code = file_get_contents($this->getFileName());
        if ($this->isPrivate()) {
            $modifier = 'private';
        } elseif ($this->isProtected()) {
            $modifier = 'protected';
        } else {
            $modifier = 'public';
        }
        if ($this->isStatic()) {
            $modifier .= ' static';
        }
        $code = explode("$modifier $".$this->getName().";\n", $code);
        return count(explode("\n", $code[0]));
    }
}

