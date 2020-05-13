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
            $isStored = $this->Model->store(Session::get('id'));
            if ($isStored) {
                Session::set('post_created', true);
                Redirect::to('dashboard/posts');
            }else $this->view->db_error = true;
        }else Session::set('posted_data', Input::getAll());
        Session::setMany(Validate::getErrors());
        Redirect::to('post/create');
    }

    /**
     * Edit     Renders view for post editing. $id = NULL due to prevent error - call method without argument.
     *
     * @param  int $id
     */
    public function edit(int $id = NULL)
    {
        if ($id) {
            $post = $this->Model->get('id', $id);

            $category = new Category();
            $this->view->categories = $category->getAll();
            if ($post) $this->view->posted_data = $post[0];
            else $this->view->db_error = true;
            
            $this->view->e_title = Session::get('e_title');
            $this->view->e_body = Session::get('e_body');
            Session::unsetMany([
                'e_title',
                'e_body',
                ]);
            $this->view->render('dashboard/edit-post');
        }else Redirect::to('dashboard/posts');
    }
        
    /**
     * update   Updates resource by given id.
     *
     */
    public function update()
    {
        if (Validate::request('POST')) {
            if (Validate::postCreateForm()) {
                $isUpdated = $this->Model->update();
                if ($isUpdated) Session::set('post_updated', true);
                else Session::set('update_error', true);
            }else {
                Session::setMany(Validate::getErrors());
                Redirect::to('post/edit/' . Input::get('post_id'));
            }
        }
        Redirect::to('dashboard/posts');
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