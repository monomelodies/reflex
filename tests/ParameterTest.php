<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Monomelodies\Reflex\ReflectionParameter;

final class ParameterTest extends TestCase
{
    public function testGetTypeReturnsAWrappedInstanceOfReflectionType() : void
    {
        $reflection = new ReflectionParameter([Tests\Foo::class, 'bar'], 'string');
        $type = $reflection->getType();
        $this->assertInstanceOf(ReflectionType::class, $type);
    }
}

