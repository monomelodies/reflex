<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Monomelodies\Reflex\ReflectionObject;

final class PropertyTest extends TestCase
{
    public function testWeCanGetTheClassnameOfTheDefiningFile() : void
    {
        $reflection = new ReflectionObject(new class {
            public $foo;
        });
        $property = $reflection->getProperty('foo');
        $this->assertEquals($property->getFileName(), __FILE__);
        $this->assertEquals($property->getLine(), 11);
    }
}

