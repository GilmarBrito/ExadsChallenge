<?php

declare(strict_types=1);

namespace ExadsChallengeTest;

use ReflectionClass as ReflectionClass;

class PHPUnitUtil
{
    public static function callMethod($obj, $name, array $args): mixed
    {
        $class = new ReflectionClass($obj);
        $method = $class->getMethod($name);

        return $method->invokeArgs($obj, $args);
    }
    public static function getProperty($object, $property)
    {
        $reflectedClass = new \ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);
        return $reflection->getValue($object);
    }
}
