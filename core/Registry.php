<?php

namespace framework;

class Registry
{
    static private $properties = [];
    use TSingleton;

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperties()
    {
        return self::$properties;
    }

    public function getProperty($name)
    {
        if(isset(self::$properties[$name]))
		{
            return self::$properties[$name];
        }
        return null;
    }
}