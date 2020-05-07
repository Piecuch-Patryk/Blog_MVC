<?php

namespace Classes;

class Route
{		

    private static $_routes = [];
    private static $_controllers = [];
    private static $_methods = [];
    private static $_controller_not_found = true;
    private static $_arg = null;
    private static $_auth = false;

    
    /**
     * set      Sets all routes defined in root/routes.php
     *
     * @param  string   $uri
     * @param  array    $options
     */
    public static function set(string $uri, array $options)
    {
        array_push(self::$_routes, $uri);
        array_push(self::$_controllers, $options['controller']);
        array_push(self::$_methods, $options['method']);
    }
    
    /**
     * execute      Search given controller_name/method_name/arg[optional] in registered routes.
     *              Shows 404 error if none found.
     *
     */
    public static function execute()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = substr($uri, strpos($uri, '/') + 1);
        $uri = explode('/', $uri);
        unset($uri[0]);

        if(count($uri) > 2 && count($uri) < 4) {
            self::$_arg = $uri[3];
            unset($uri[3]);
        } 

        $uri = '/' . join('/', $uri);
        
        foreach (self::$_routes as $key => $value) {
            if($value === $uri) {
                $controllerPath = './Controllers/' . self::$_controllers[$key] . '.php';
                if(file_exists($controllerPath)) {
                    self::$_controller_not_found = false;
                    $controller = 'Controllers\\' . self::$_controllers[$key];
                    $controller = new $controller;
                    $controller->loadModel(self::$_controllers[$key]);

                    $method = self::$_methods[$key];

                    if(self::$_arg != null) $controller->{$method}(self::$_arg);
                    else $controller->{$method}();
                }
                break;
            }
        }
        if(self::$_controller_not_found) {
            $controller = 'Controllers\Error';
            $controller = new $controller;
            $controller->pageNotFound();
        }

    }
}