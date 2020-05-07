<?php

namespace Controllers;

use Classes\Session;
use Classes\Redirect;

class Home extends Controller
{
    public function __construct()
    {
        if(Session::check('logged', true)) Redirect::to('dashboard');
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('home/index');
    }
}