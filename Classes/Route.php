<?php

namespace Classes;

class Route
{
    private $_routes = [];
    private $_controllers = [];
    private $_methods = [];
    private $_controller_not_found = true;

    public function set(string $uri, array $options)
    {
        array_push($this->_routes, $uri);
        array_push($this->_controllers, $options['controller']);
        array_push($this->_methods, $options['method']);
    }

    public function execute()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = substr($uri, strpos($uri, '/') + 1);
        $uri = explode('/', $uri);
        unset($uri[0]);
        $uri = '/' . join('/', $uri);

        foreach ($this->_routes as $key => $value) {
            if($value === $uri) {
                $controllerPath = './Controllers/' . $this->_controllers[$key] . '.php';
                if(file_exists($controllerPath)) {
                    $this->_controller_not_found = false;
                    $controller = 'Controllers\\' . $this->_controllers[$key];
                    $controller = new $controller;

                    $method = $this->_methods[$key];
                    $controller->{$method}();
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


    // public function __construct()
    // {
    //     $url = $_SERVER['REQUEST_URI'];
    //     $controller = $this->urlController($url);
    //     $model = $this->urlModel($controller);
    //     $method = $this->urlMethod($url);
    //     $arg = $this->urlArg($url);

    //     // echo $url;

    //     $controller = new $controller;
    //     $controller->loadModel($model);
        
    //     if(!empty($method) && !empty($arg) && method_exists($controller, $method)) {
    //         $controller->{$method}($arg);
    //         echo 'in up';
    //     }
    //     elseif(!empty($method) && method_exists($controller, $method)) {
    //         $controller->{$method}();
    //         echo 'in';
    //     } else {
            
    //     }
    // }
    
    // /**
    //  * urlController    Returns controller name from url
    //  *
    //  * @param  string $url
    //  * @return string $name
    //  */
    // private function urlController(string $url)
    // {
    //     $name = explode('/' ,$url);
    //     if(!empty($name[2])) {

    //         echo $name[2];

    //         $name = rtrim($name[2]);
    //         $name = preg_replace("/[^a-zA-z]+/", "", $name);
    //         $name = strtolower($name);
    //         $name = ucfirst($name);

    //         if(!class_exists("\Controllers\\$name", false)) return '\Controllers\Error';
    //         else return "\Controllers\\$name";
    //     }
    //     else return '\Controllers\Home';
    // }

    // /**
    //  * urlModel    Returns model name from controller name
    //  *
    //  * @param  string $controller
    //  * @return string $name
    //  */
    // private function urlModel(string $controller)
    // {
    //     $name = explode('\\' ,$controller);
    //     return $name[2];
    // }

    // /**
    //  * urlMethod    Returns method name from url. 
    //  *              Replaces '-' with camelCase.
    //  *
    //  * @param  string $url
    //  * @return string $name
    //  */
    // private function urlMethod(string $url)
    // {
    //     $name = explode('/' ,$url);
    //     if(count($name) >= 4) {
    //         $name = explode('-', $name[3]);
    //         foreach ($name as $key => $value) {
    //             if($key !== 0) $name[$key] = ucfirst($value);
    //         }
    //         $name = implode('', $name);
    //         return $name;
    //     }
    //     // else return 'index';
    // }

    // /**
    //  * urlArg    Returns argument value from url
    //  *
    //  * @param  string $url
    //  * @return string $argument
    //  */
    // private function urlArg(string $url)
    // {
    //     $argument = explode('/' ,$url);
    //     if(count($argument) >= 5) return trim($argument[4]);
    //     else return '';
    // }
}