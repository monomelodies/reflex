<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Monomelodies\Reflex\ReflectionMethod;

final class ClassTest extends TestCase
{
    public function testGetMethodsReturnsAnArrayOfWrappedReflectionMethods() : void
    {
        $reflection = new Monomelodies\Reflex\ReflectionClass(Tests\Foo::class);
        $methods = $reflection->getMethods();
        $this->assertInstanceOf(ReflectionMethod::class, $methods[0]);
    }
}

