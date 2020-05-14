<?php

namespace Controllers;

use Classes\Session;
use Classes\Validate;
use Classes\Redirect;
use Classes\Input;

class Comment extends Controller
{

    public function store()
    {
        if (Validate::commentForm()) {
            $comment = $this->Model->store();

            if ($comment) {
                Session::set('comment_added', true);
            }else Session::set('db_error_comment', true);
        }else Session::set('validate_error', true);

        Session::set('posted_data', Input::getAll());
        Session::setMany(Validate::getErrors());
        Redirect::to('post/show/' . Input::get('post_id'));
    }

}