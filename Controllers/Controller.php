<?php

namespace Controllers;

use Classes\View;

class Controller
{
    public function __construct()
    {
        $this->view = new View();
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