<?php

namespace Controllers;

use Models\Category;
use Classes\Validate;
use Classes\Input;
use Classes\Session;
use Classes\Redirect;

class Post extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * showAll      Renders view with all posts.
     *
     */
    public function showAll()
    {
        $this->view->render('post/showAll');
    }
        
    /**
     * create   Creates new post.
     *
     */
    public function create()
    {
        $categories = new Category();
        $this->view->categories = $categories->getAll();
        $this->view->e_title = Session::get('e_title');
        $this->view->e_body = Session::get('e_body');
        $this->view->posted_data = Session::get('posted_data');
        Session::unsetMany([
            'e_title',
            'e_body',
            'posted_data',
        ]);

        $this->view->render('dashboard/create-post');
    }
    
    /**
     * store    Stores new post in db if valid.
     *
     */
    public function store()
    {
        if (Validate::postCreateForm()){
            $isStored = $this->Model->store();
            if ($isStored) {
                Session::set('post_created', true);
                Redirect::to('dashboard/posts');
            }else $this->view->db_error = true;
        }else Session::set('posted_data', Input::getAll());
        Session::setMany(Validate::getErrors());
        Redirect::to('post/create');
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
    
    /**
     * destroy      Deletes post by given id. $id = NULL due to prevent error - call method without argument.
     *
     * @param  mixed $id
     */
    public function destroy($id = NULL)
    {
        if ($id) {
            $isDestroyed = $this->Model->destroy($id);
            if ($isDestroyed) Session::set('post_deleted', true);
        }
        Redirect::to('dashboard/posts');
    }
}