<?php

namespace Controllers;

use Classes\Validate;
use Classes\Redirect;
use Classes\Auth;

class User extends Controller
{

    public function index()
    {
        $this->view->render('user/index');
    }

    public function login()
    {
        $errors = Validate::loginForm();
        
        if(!is_array($errors)) {
            $user = $this->Model->login($_POST['email'], $_POST['password']);

            if($user) {
                // Logged in
                Auth::setLogged();
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
        Auth::destroyLogin();
    }

}