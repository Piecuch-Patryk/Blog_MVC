<?php

namespace Controllers;


class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pageNotFound()
    {
        $this->view->pageTitle = '404 - Page not found';
        $this->view->render('error/page-not-found');
    }
}