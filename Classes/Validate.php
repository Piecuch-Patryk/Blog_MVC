<?php

namespace Classes;

use Classes\Input;

class Validate
{
    private static $_errors = [];
    

    public static function getErrors()
    {
        return self::$_errors;
    }

    /**
     * request      Validates if request equals given type.
     *
     * @return bool
     */
    public static function request(string $type)
    {
        return $_SERVER['REQUEST_METHOD'] === $type;
    }
    
    /**
     * createUserForm   Validates create user form.
     *
     * @return mixed true || array $_errors
     */
    public static function createUserForm()
    {
        self::name();
        self::surname();
        self::email();
        self::password();
        self::passwordMatch();

        return empty(self::$_errors);
    }
    
    /**
     * loginForm    Validates login form.
     *
     * @return bool
     */
    public static function loginForm()
    {
        self::email();
        self::password();

        return empty(self::$_errors);
    }
    
    /**
     * postCreateForm   Validates post-create form.
     *
     * @return bool
     */
    public static function postCreateForm()
    {
        self::title();
        self::body();

        return empty(self::$_errors);
    }
    
    /**
     * title    Validates title.
     *
     */
    private static function title()
    {
        $title = Input::get('title');

        if (empty($title)) self::$_errors['e_title'] = 'Title required.';
        else self::resetArrayField('e_title');
    }
    
    /**
     * body     Validates body.
     *
     */
    private static function body()
    {
        $body = Input::get('body');

        if (empty($body)) self::$_errors['e_body'] = 'Post\'s body can not be empty.';
        else self::resetArrayField('e_body');
    }
    
    /**
     * email    Validates email address.
     *
     */
    private static function email()
    {
        $email = Input::get('email');

        if (empty($email)) self::$_errors['e_email'] = 'Email address required.';
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) self::$_errors['e_email'] = 'Provide correct email address.';
        else self::resetArrayField('e_email');
    }
    
    /**
     * password     Validates password.
     *
     */
    private static function password()
    {
        $password = Input::get('password');
        if (empty($password)) self::$_errors['e_password'] = 'Password required.';
        else self::resetArrayField('e_password');
    }
    
    /**
     * name     Validates name.
     *
     */
    private static function name()
    {
        $name = Input::get('name');
        if  (empty($name)) self::$_errors['e_name'] = 'Name required.';
        else if (!ctype_alpha($name)) self::$_errors['e_name'] = 'Name can only contains letters.';
        else self::resetArrayField('e_name');
    }
    
    /**
     * surname  Validates surname.
     *
     */
    private static function surname()
    {
        $name = Input::get('surname');
        if  (empty($name)) self::$_errors['e_surname'] = 'Surname required.';
        else if (!ctype_alpha($name)) self::$_errors['e_surname'] = 'Surname can only contains letters.';
        else self::resetArrayField('e_surname');
    }
    
    /**
     * passwordMatch    Check if both passwords match.
     *
     */
    private static function passwordMatch()
    {
        $password_1 = Input::get('password');
        $password_2 = Input::get('password-repeat');
        if ($password_1 !== $password_2) self::$_errors['e_password-repeat'] = 'Both passwords must be the same.';
        else self::resetArrayField('e_password-repeat');
    }
    
    /**
     * resetArrayField      Unsets errors private array by given key $_errors[$key].
     *
     * @param  string $key
     */
    private static function resetArrayField($key)
    {
        unset(self::$_errors[$key]);
    }
}