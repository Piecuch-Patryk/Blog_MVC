<?php

namespace Controllers;

class Post extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showAll()
    {
        $this->view->render('post/showAll');
    }

    public function Edit(int $id)
    {
        echo 'edit post: ' . $id;
    }
}