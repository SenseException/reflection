<?php

namespace Doctrine\Tests_PHP74\Common\Reflection;

use Doctrine\Common\Reflection\TypedNoDefaultReflectionProperty;
use PHPUnit\Framework\TestCase;

class TypedNoDefaultReflectionPropertyTest extends TestCase
{
    public function testGetValue() : void
    {
        $object = new TypedNoDefaultReflectionPropertyTestClass();

        $reflProperty = new TypedNoDefaultReflectionProperty(TypedNoDefaultReflectionPropertyTestClass::class, 'test');

        self::assertNull($reflProperty->getValue($object));

        $object->test = 'testValue';

        self::assertSame('testValue', $reflProperty->getValue($object));

        unset($object->test);

        self::assertNull($reflProperty->getValue($object));
    }

    public function testGetValueNullIfUninitialized() : void
    {
        $object = new TypedFoo();

        $reflection = new TypedNoDefaultReflectionProperty($object, 'id');

        $this->assertNull($reflection->getValue($object));

        $object->id = 1;

        $this->assertEquals(1, $reflection->getValue($object));
    }
}

class TypedNoDefaultReflectionPropertyTestClass
{
    public string $test;
}

class TypedFoo
{
    public int $id;
}
