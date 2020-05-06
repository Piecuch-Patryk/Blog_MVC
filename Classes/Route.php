<?php

namespace Classes;

class Route
{		
    private $_routes = [];
    private $_controllers = [];
    private $_methods = [];
    private $_controller_not_found = true;
    private $_arg = null;

    public function set(string $uri, array $options)
    {
        array_push($this->_routes, $uri);
        array_push($this->_controllers, $options['controller']);
        array_push($this->_methods, $options['method']);
    }
    
    /**
     * execute      Search given controller_name/method_name/arg[optional] in registered routes.
     *              Shows 404 error if none found.
     *
     * @return void
     */
    public function execute()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = substr($uri, strpos($uri, '/') + 1);
        $uri = explode('/', $uri);
        unset($uri[0]);

        if(count($uri) > 2 && count($uri) < 4) {
            $this->_arg = $uri[3];
            unset($uri[3]);
        } 

        $uri = '/' . join('/', $uri);
        
        foreach ($this->_routes as $key => $value) {
            if($value === $uri) {
                $controllerPath = './Controllers/' . $this->_controllers[$key] . '.php';
                if(file_exists($controllerPath)) {
                    $this->_controller_not_found = false;
                    $controller = 'Controllers\\' . $this->_controllers[$key];
                    $controller = new $controller;

                    $method = $this->_methods[$key];

                    if($this->_arg != null) $controller->{$method}($this->_arg);
                    else $controller->{$method}();
                }
                break;
            }
        }
        if($this->_controller_not_found) {
            $controller = 'Controllers\Error';
            $controller = new $controller;
            $controller->pageNotFound();
        }

    }
}