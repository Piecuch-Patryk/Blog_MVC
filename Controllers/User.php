<?php

namespace Controllers;

use Classes\Validate;
use Classes\Redirect;
use Classes\Input;
use Classes\Auth;
use Classes\Session;

class User extends Controller
{
    public function index()
    {
        if (Session::check('loginError', true)) $this->view->postedData = Session::get('email');
        $this->view->render('user/index');
    }

    public function store()
    {
        if (!Validate::request()) Redirect::to('home');

        $errors = Validate::createUserForm();
        $userExists = $this->Model->get(Input::get('email'));
        $postedData = Input::getAll();

        if ($userExists) {
            // Error - user occurs in db
            $this->view->userExists = true;
            $this->view->postedData = $postedData;
            $this->view->render('dashboard/create-user');
        }
        else if(!is_array($errors)) {
            $result = $this->Model->store();

            if($result) {
                Session::set('userCreated', 'User created successfully.');
                Redirect::to('dashboard/users');
            }else {
                // Error
                $this->view->error = 'Something went wrong. Please try again.';
                $this->view->render('dashboard/create-user');
            }
        }else {
            // Error - validation fail
            $this->view->postedData = $postedData;
            $this->view->errors = $errors;
            $this->view->render('dashboard/create-user');
        }
    }

    public function login()
    {
        if (!Validate::request()) Redirect::to('home');
        $errors = Validate::loginForm();
        $sessionData = [
            'loginError' => true,
            'email' => Input::get('email'),
        ];
        
        if(!is_array($errors)) {
            $user = $this->Model->login();

            if($user) {
                // Logged in
                Auth::setLogged();
                Redirect::to('dashboard');
            }else {
                // Error - wrong email/password
                Session::setMany($sessionData);
                Redirect::to('login');
            }
        }else {
            // Error - validation fail
            Session::setMany($sessionData);
            Redirect::to('login');
        }
    }

    public function showAll()
    {
        $isUserCreated = Session::get('userCreated');
        if ($isUserCreated) $this->view->userCreated = $isUserCreated;
        $this->view->render('dashboard/users');
    }

    public function logout()
    {
        Auth::destroyLogin();
    }

}