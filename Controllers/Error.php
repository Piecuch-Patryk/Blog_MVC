<?php

namespace Controllers;


class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * pageNotFound     Renders error page - 404.
     *               ***TO DO ***
     *               !!!Need to use proper redirect with 404 header.!!!
     *
     */
    public function pageNotFound()
    {
        $this->view->pageTitle = '404 - Page not found';
        $this->view->render('error/page-not-found');
    }
}