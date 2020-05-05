<?php

class Router
{

    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $controller = $this->urlController($url);
        $model = $this->urlModel($controller);
        $method = $this->urlMethod($url);
        $arg = $this->urlArg($url);

        $controller = new $controller;
        $controller->loadModel($model);
        
        if(!empty($method) && !empty($arg)) $controller->{$method}($arg);
        elseif(!empty($method) && method_exists($controller, $method)) $controller->{$method}();
    }
    
    /**
     * urlController    Returns controller name from url
     *
     * @param  string $url
     * @return string $name
     */
    private function urlController(string $url)
    {
        $name = explode('/' ,$url);
        if(!empty($name[2])) {
            $name = rtrim($name[2]);
            $name = preg_replace("/[^a-zA-z]+/", "", $name);
            $name = strtolower($name);
            $name = ucfirst($name);

            if(!class_exists("\Controllers\\$name", false)) return '\Controllers\Error';
            else return "\Controllers\\$name";
        }
        else return '\Controllers\Home';
    }

    /**
     * urlModel    Returns model name from controller name
     *
     * @param  string $controller
     * @return string $name
     */
    private function urlModel(string $controller)
    {
        $name = explode('\\' ,$controller);
        return $name[2];
    }

    /**
     * urlMethod    Returns method name from url. 
     *              Replaces '-' with camelCase.
     *
     * @param  string $url
     * @return string $name
     */
    private function urlMethod(string $url)
    {
        $name = explode('/' ,$url);
        if(count($name) >= 4) {
            $name = explode('-', $name[3]);
            foreach ($name as $key => $value) {
                if($key !== 0) $name[$key] = ucfirst($value);
            }
            $name = implode('', $name);
            return $name;
        }
        else return 'index';
    }

    /**
     * urlArg    Returns argument value from url
     *
     * @param  string $url
     * @return string $argument
     */
    private function urlArg(string $url)
    {
        $argument = explode('/' ,$url);
        if(count($argument) >= 5) return trim($argument[4]);
        else return '';
    }
}