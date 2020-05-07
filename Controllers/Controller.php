<?php

namespace Controllers;

use Classes\View;
use Classes\Session;

class Controller
{
    public function __construct()
    {
        $this->view = new View();
        if (Session::check('logged', true)) $this->view->logged = true;
        else $this->view->logged = false;
    }
    
    /**
     * loadModel
     *
     * @param  string $name
     */
    public function loadModel(string $modelName)
    {
        $model = "Models\\$modelName";
        $path = "Models/$modelName.php";
        if(file_exists($path)) $this->Model = new $model();
    }
}