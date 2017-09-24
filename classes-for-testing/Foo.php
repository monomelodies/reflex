<?php

namespace Tests;

class Foo
{
    public function bar(string $string) :? array
    {
        return strlen($string) ? str_split($string, 1) : null;
    }
}

