<?php

namespace Controllers;

use Classes\Auth;
use Classes\Redirect;

class Home extends Controller
{
    public function __construct()
    {
        if(Auth::checkLogin()) Redirect::to('dashboard');
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('home/index');
    }
}