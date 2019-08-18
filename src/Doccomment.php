<?php

namespace Monomelodies\Reflex;

trait Doccomment
{
    public function getCleanedDocComment(bool $strip_annotations = true) : string
    {
        $doccomment = $this->getDocComment();
        $doccomment = preg_replace("@^/\*\*@", '', $doccomment);
        $doccomment = preg_replace("@\*/$@m", '', $doccomment);
        if ($strip_annotations) {
            $doccomment = preg_replace("/^\s*\*\s*@\w+.*?$/m", '', $doccomment);
        }
        $doccomment = preg_replace("@^\s*\*\s*@m", '', $doccomment);
        $doccomment = str_replace("\n", ' ', $doccomment);
        $doccomment = trim(preg_replace("@\s{2,}@", ' ', $doccomment));
        return $doccomment;
    }
}

