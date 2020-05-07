<?php

namespace Controllers;

use Classes\View;
use Classes\Session;

class Controller
{    
    /**
     * __construct      Instantiates View class to use within this class.
     *                  Sets user data for logged in/out user.
     *
     */
    public function __construct()
    {
        $this->view = new View();
        if (Session::check('logged', true)) {
            $this->view->logged = true;
            $this->view->loggedUserRole = Session::get('role');
        }
        else $this->view->logged = false;
    }
    
    /**
     * loadModel    Loads model if exists.
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