<?php

class StaticMockTestClass
{
    public static function doSomethingElse()
    {
        return static::doSomething();
    }

    public static function doSomething()
    {
    }
}
