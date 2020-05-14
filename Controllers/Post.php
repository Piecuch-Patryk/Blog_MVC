<?php

namespace Controllers;

use Models\Category;
use Models\Comment;
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
    public function show(int $id)
    {
        $post = $this->Model->get('id', $id);

        if ($post){
            $this->view->post = $post[0];
            $related_posts = $this->Model->get('category_id', $post[0]['category_id']);
            $comment = new Comment();
            $related_comments = $comment->get($id);

            if ($related_posts) $this->view->related_posts = $related_posts;
            else $this->view->related_posts_error = true;

            if ($related_comments) {
                if (count($related_comments) > 0) $this->view->related_comments = $related_comments;
                else $this->view->no_related_comments = true;
            }
        }
        else $this->view->db_error = true;
        
        $this->view->comment_added = Session::get('comment_added');
        $this->view->db_error_comment = Session::get('db_error_comment');
        $this->view->e_name = Session::get('e_name');
        $this->view->e_body = Session::get('e_body');
        $this->view->posted_data = Session::get('posted_data');
        $this->view->validate_error = Session::get('validate_error');
        Session::unsetMany([
            'comment_added',
            'db_error_comment',
            'e_name',
            'e_body',
            'posted_data',
            'validate_error',
            ]);

        $this->view->render('post/show');
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