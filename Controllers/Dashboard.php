<?php

namespace Controllers;

use Classes\Auth;
use Classes\Session;

class Dashboard extends Controller
{
    public function __construct()
    {
        Auth::checkLogin();
        parent::__construct();
        $this->view->userData = $_SESSION;
        $this->view->logged = true;
    }
    public function index()
    {
        $this->view->pageTitle = 'Dashboard - ' . Session::get('fullName');
        $this->view->render('dashboard/index');
    }
}