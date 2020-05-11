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
    }

    /**
     * index        Renders login page.
     *              If form validation fails, shows last typed values. (better UX)
     *
     */
    public function index()
    {
        if (Session::check('login_form_fail', true)) {
            $this->view->old_email = Session::get('old_email');
            $this->view->e_login_pair = Session::get('e_login_pair');
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
        if (!Validate::request('POST')) Redirect::to('home');
        if (Validate::createUserForm()) {
            $userExists = $this->Model->get('email' ,Input::getSafe('email'));
            if (!$userExists) {
                $result = $this->Model->store();
                if($result) {
                    $this->view->role = SESSION::get('role');
                    Session::set('user_created', true);
                    Redirect::to('dashboard/users');
                }else $this->view->db_error = true;      // Error - database error
            }else $rhis->view->user_exists = true;      // Error - user unique
        }else $this->view->errors = Validate::getErrors();    // Error - form validation failed

        $this->view->posted_data = Input::getAll();
        $this->view->render('dashboard/create-user');
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
            }else Session::set('e_login_pair', true);     // Error - wrong login or password
        }else Session::setMany(Validate::getErrors());    // Error - validation fails
        
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
        $user_created = Session::get('user_created');
        if ($user_created) $this->view->user_created = true;

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
            $this->view->full_name = $user['name'] . ' ' . $user['surname'];
            foreach ($user as $key => $value) $this->view->{$key} = $value;
        }
        else $this->view->user_data_error = true;

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