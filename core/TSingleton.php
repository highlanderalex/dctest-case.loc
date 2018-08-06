<?php

namespace framework;

trait TSingleton
{
    private static $instance = null;

    public static function instance()
    {
        if (self::$instance == null) 
		{
            return self::$instance = new self();
        }
        return self::$instance;
    }
}