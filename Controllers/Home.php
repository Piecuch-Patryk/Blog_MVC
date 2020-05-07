<?php

namespace Controllers;

use Classes\Session;
use Classes\Redirect;

class Home extends Controller
{    
    /**
     * __construct      Redirects logged users to dashboard main page.
     *
     */
    public function __construct()
    {
        if(Session::check('logged', true)) Redirect::to('dashboard');
        else Session::destroy();
        parent::__construct();
    }
    
    /**
     * index    Renders main page.
     *
     * @return void
     */
    public function index()
    {
        $this->view->render('home/index');
    }
}