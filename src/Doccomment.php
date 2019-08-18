<?php

namespace Monomelodies\Reflex;

trait Doccomment
{
    public function getCleanedDocComment(bool $strip_annotations = true) : string
    {
        $doccomment = $this->getDocComment();
        $doccomment = preg_replace("@^/\*\*\n@", '', $doccomment);
        $doccomment = preg_replace("@^\s*\*/$@m", '', $doccomment);
        if ($strip_annotations) {
            $doccomment = preg_replace("/^\s*\*\s*@\w+.*?$/m", '', $doccomment);
        }
        $doccomment = preg_replace("@^\s*\*[ ]{0,1}@m", '', $doccomment);
        return trim($doccomment);
    }
}

