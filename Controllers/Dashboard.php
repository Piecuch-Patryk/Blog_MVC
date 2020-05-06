<?php

namespace Controllers;

use Classes\Session;

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
    }
    public function index()
    {
        echo 'dahsboard';
    }
}