<?php

namespace Controllers;

use Classes\Validate;
use Classes\Redirect;
use Classes\Session;

class User extends Controller
{

    public function index()
    {
        Session::init();
        if(Session::check('logged', true)) Redirect::to('dashboard');
        $this->view->render('user/index');
    }


    public function login()
    {
        $errors = Validate::loginForm();
        
        if(!is_array($errors)) {
            $user = $this->Model->login($_POST['email'], $_POST['password']);

            if($user) {
                // Logged in
                Redirect::to('dashboard');
            }else {
                // Error - wrong email/password
                Redirect::to('login');
            }
        }else {
            // Error - validation fail
            Redirect::to('login');
        }
    }

    public function logout()
    {
        Session::destroy();
        Redirect::to('home');
    }

}