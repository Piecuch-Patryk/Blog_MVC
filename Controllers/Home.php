<?php

namespace Controllers;

use Classes\Session;
use Classes\Redirect;
use Models\Post;
use Models\Category;

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
    public function index(int $category_id = NULL)
    {
        $post = new Post();
        $category = new Category();
        $posts = $category_id !== NULL ? $post->get('category_id', $category_id) : $post->getAll();
        $categories = $category->getAll();

        if ($posts) {
            $this->view->posts = $posts;
            $this->view->categories = $categories;
        }
        else $this->view->db_error = true;

        $this->view->active_category = $category_id;
        $this->view->render('home/index');
    }

    public function category(string $category_name)
    {
        $category = new Category();
        $category = $category->get($category_name);
        $category_id = $category['id'];
        $this->index($category_id);
    }
}