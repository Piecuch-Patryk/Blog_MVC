<?php

namespace Controllers;

use Classes\Auth;

class Dashboard extends Controller
{
    public function __construct()
    {
        Auth::checkLogin();
        parent::__construct();
        $this->userData = $_SESSION;
    }
    public function index()
    {
        $this->view->render('dashboard/index');
    }
}