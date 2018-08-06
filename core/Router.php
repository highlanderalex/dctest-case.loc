<?php

namespace framework;

class Router
{
    private static $route = [];

    private static $routes = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) 
			{
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($controllerObject,$action))
				{
                    $controllerObject->$action();
                    $controllerObject->getView();
                }
				else
				{
                    throw new \Exception("Method not found {$controller}::{$action}", 404);
                }
            } 
			else 
			{
                throw new \Exception("Class not found {$controller}", 404);
            }
        } 
		else 
		{
            throw new \Exception("Page not found", 404);
        }
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) 
		{
            if (preg_match("#{$pattern}#", $url, $mathes)) 
			{
                foreach ($mathes as $key => $value) 
				{
                    if (is_string($key)) 
					{
                        $route[$key] = $value;
                    }
                }
                if (!isset($route['action'])) 
				{
                    $route['action'] = 'index';
                }
                if (empty($route['prefix'])) 
				{
                    $route['prefix'] = '';
                } 
				else 
				{
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    public static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }
	
    public static function removeQueryString($url)
    {
        if($url)
		{
            $params = explode('&', $url, 2);
            if(false === strpos($params[0], '='))
			{
                return rtrim($params[0], '/');
            }
			else
			{
                return '';
            }
        }
    }
}