<?php

namespace Controllers;

use Classes\Validate;
use Classes\Redirect;
use Classes\Input;
use Classes\Auth;
use Classes\Session;

class User extends Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->view->postedData = '';
        $this->view->e_email = '';
        $this->view->e_password = '';
        $this->view->e_logging = '';
    }

    /**
     * index        Renders login page.
     *              If form validation fails, shows last typed values. (better UX)
     *
     */
    public function index()
    {
        if (Session::check('loginError', true)) {
            $this->view->e_logging = true;
            $this->view->postedData = Session::get('email');
            $this->view->e_email = Session::get('e_email');
            $this->view->e_password = Session::get('e_password');
        }
        $this->view->render('user/index');
    }
    
    /**
     * store        Stores created user in database.
     *              Only if given email does not occur in database.
     *
     */
    public function store()
    {
        if (!Validate::request()) Redirect::to('home');

        $errors = Validate::createUserForm();
        $userExists = $this->Model->get('email' ,Input::get('email'));
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
                Session::set('userCreated', true);
                Redirect::to('dashboard/users');
            }else {
                // Error
                $this->view->error = true;
                $this->view->render('dashboard/create-user');
            }
        }else {
            // Error - validation fail
            $this->view->postedData = $postedData;
            $this->view->errors = $errors;
            $this->view->render('dashboard/create-user');
        }
    }
    
    /**
     * login        Performs login form validation.
     *
     */
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
                Session::set('role', $user['role']);
                Redirect::to('dashboard');
            }else {
                // Error - wrong email/password
                Session::setMany($sessionData);
                Redirect::to('login');
            }
        }else {
            // Error - validation fail
            Session::setMany($sessionData);
            Session::setMany($errors);
            Redirect::to('login');
        }
    }
    
    /**
     * showAll      Shows all users.
     *
     */
    public function showAll()
    {
        $isUserCreated = Session::get('userCreated');
        if ($isUserCreated) $this->view->userCreated = $isUserCreated;

        $users = $this->Model->getAll();
        $this->view->users = $users;
        $this->view->render('dashboard/users');
    }
    
    /**
     * edit     Renders view for user edit with the user's data.
     *
     * @param  int $id
     */
    public function edit(int $id)
    {
        $user = $this->Model->get('id', $id);

        if ($user) {
            $this->view->fullName = $user['name'] . ' ' . $user['surname'];
            foreach ($user as $key => $value) $this->view->{$key} = $value;
        }
        else $this->view->userDataError = true;

        $this->view->render('dashboard/edit-user');
    }
    
    /**
     * delete       Delets user by given id.
     *
     * @param  int $id
     */
    public function delete(int $id)
    {
        var_dump($id);
    }
    
    /**
     * logout       Performs logout action.
     *
     * @return void
     */
    public function logout()
    {
        Auth::destroyLogin();
    }

}