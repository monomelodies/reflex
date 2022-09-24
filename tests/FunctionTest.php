<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Monomelodies\Reflex\ReflectionFunction;

final class FunctionTest extends TestCase
{
    public function testWeCanGetAllPossibleCalls() : void
    {
        $fn = new ReflectionFunction(fn (string $foo, int $bar = 0, bool $baz = false) => false);
        $calls = $fn->getPossibleCalls(...$fn->getParameters());
        $this->assertEquals(count($calls), 3);
    }

    public function testWeCanGetAllPossibleReturnTypes() : void
    {
        $fn = new ReflectionFunction(fn (string $foo, int $bar = 0, bool $baz = false) :? bool => false);
        $returnTypes = $fn->getPossibleReturnTypes();
        $this->assertEquals(count($returnTypes), 2);
    }
}

