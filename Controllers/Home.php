<?php

namespace Controllers;

use Classes\Session;
use Classes\Redirect;
use Models\Post;

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
        $post = new Post();
        $posts = $post->getAll();
        if ($posts) $this->view->posts = $posts;
        else $this->view->db_error = true;

        $this->view->render('home/index');
    }
}