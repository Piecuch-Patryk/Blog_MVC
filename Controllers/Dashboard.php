<?php

namespace Controllers;

use Classes\Auth;
use Classes\Session;

class Dashboard extends Controller
{    
    /**
     * __construct      Restricted to logged in users.
     *                  Redirects if not logged in.
     *                  Sets logged in data if logged in.
     */
    public function __construct()
    {
        Auth::checkLogin();
        parent::__construct();
        $this->view->userData = $_SESSION;
        $this->view->logged = true;
        $this->view->postedData = '';
    }
        
    /**
     * index        Renders dashboard main page.
     *
     */
    public function index()
    {
        $this->view->pageTitle = 'Dashboard - ' . Session::get('fullName');
        $this->view->render('dashboard/index');
    }
    
    /**
     * createUser   Renders dashboard - create user.
     *
     */
    public function createUser()
    {
        $this->view->render('dashboard/create-user');
    }
}