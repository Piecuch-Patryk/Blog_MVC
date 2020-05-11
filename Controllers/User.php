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
        $this->view->e_logging = NULL;
        $this->view->old_email = NULL;
        $this->view->e_email = NULL;
        $this->view->e_password = NULL;
        $this->view->e_logging = NULL;
    }

    /**
     * index        Renders login page.
     *              If form validation fails, shows last typed values. (better UX)
     *
     */
    public function index()
    {
        if (Session::check('login_form_fail', true)) {
            $this->view->e_logging = Session::get('e_login_pair');
            $this->view->old_email = Session::get('old_email');
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
        if (!Validate::request('POST')) Redirect::to('home');
        if (Validate::loginForm()) {
            $user = $this->Model->login();

            if ($user) {
                // Logged in
                Auth::setLogged();
                Session::setMany($user);
                Redirect::to('dashboard');
            }else {
                // Error - wrong login or password
                Session::set('e_login_pair', true);
            }
        }else {
            // Error - validation fails
            Session::setMany(Validate::getErrors());
        }
        
        Session::setMany([
            'old_email' => Input::getSafe('email'),
            'login_form_fail' => true,
        ]);
        Redirect::to('login');
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