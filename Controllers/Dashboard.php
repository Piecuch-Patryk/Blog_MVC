<?php

namespace Controllers;

use Classes\Auth;
use Classes\Session;
use Models\Post;

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
        $this->view->user_data = $_SESSION;
        $this->view->logged = true;
        $this->view->postedData = '';
    }
        
    /**
     * index        Renders dashboard main page.
     *
     */
    public function index()
    {
        $this->view->pageTitle = 'Dashboard - ' . Session::get('name') . ' ' . Session::get('surname');
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
    
    /**
     * posts    Retrives current user posts and renders view with them. 
     *
     */
    public function posts()
    {
        $post = new Post();
        $posts = $post->getAll('user_id', Session::get('id'));

        if ($posts) {
            $this->view->posts = $posts;
        }else $this->view->db_error = true;

        $this->view->update_error = Session::get('update_error');
        $this->view->post_created = Session::get('post_created');
        $this->view->post_deleted = Session::get('post_deleted');
        $this->view->post_updated = Session::get('post_updated');
        Session::unsetMany([
            'update_error',
            'post_created',
            'post_deleted',
            'post_updated',
        ]);
        
        $this->view->render('dashboard/posts');
    }
}