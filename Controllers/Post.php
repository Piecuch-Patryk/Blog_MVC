<?php

namespace Controllers;

class Post extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * showAll      Renders view with all posts.
     *
     * @return void
     */
    public function showAll()
    {
        $this->view->render('post/showAll');
    }
    
    /**
     * Edit     Renders view for post editing.
     *
     * @param  mixed $id
     */
    public function Edit(int $id)
    {
        echo 'edit post: ' . $id;
    }
}