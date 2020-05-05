<?php

namespace Controllers;

use Classes\Redirect;

class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        Redirect::to('error/page-not-found');
    }

    public function pageNotFound()
    {
        $this->view->pageTitle = '404 - Page not found';
        $this->view->render('error/page-not-found');
    }
}