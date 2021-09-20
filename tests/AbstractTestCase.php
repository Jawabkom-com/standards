<?php

namespace Jawabkom\Standard\Test;

use PHPUnit\Framework\TestCase;

class AbstractTestCase extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    protected static function callInaccessibleMethod($object, $method, array $args=[]) {
        $class = new \ReflectionClass(get_class($object));
        $method = $class->getMethod($method);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }

}