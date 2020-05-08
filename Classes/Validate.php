<?php

namespace Classes;

use Classes\Input;

class Validate
{
    private static $_errors = [];
    
    /**
     * request      Validates if request equals POST.
     *
     * @return bool
     */
    public static function request()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
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

        if(empty(self::$_errors)) return true;
        else return self::$_errors;
    }

    public static function loginForm()
    {
        self::email();
        self::password();
        if(empty(self::$_errors)) return true;
        else return self::$_errors;
    }

    private static function email()
    {
        $email = Input::get('email');

        if (empty($email)) self::$_errors['e_email'] = 'Email address required.';
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) self::$_errors['e_email'] = 'Provide correct email address.';
        else self::resetArrayField('e_email');
    }

    private static function password()
    {
        $password = Input::get('password');
        if (empty($password)) self::$_errors['e_password'] = 'Password required.';
        else self::resetArrayField('e_password');
    }

    private static function name()
    {
        $name = Input::get('name');
        if  (empty($name)) self::$_errors['e_name'] = 'Name required.';
        else if (!ctype_alpha($name)) self::$_errors['e_name'] = 'Name can only contains letters.';
        else self::resetArrayField('e_name');
    }

    private static function surname()
    {
        $name = Input::get('surname');
        if  (empty($name)) self::$_errors['e_surname'] = 'Surname required.';
        else if (!ctype_alpha($name)) self::$_errors['e_surname'] = 'Surname can only contains letters.';
        else self::resetArrayField('e_surname');
    }

    private static function passwordMatch()
    {
        $password_1 = Input::get('password');
        $password_2 = Input::get('password-repeat');
        if ($password_1 !== $password_2) self::$_errors['e_password-repeat'] = 'Both passwords must be the same.';
        else self::resetArrayField('e_password-repeat');
    }

    private static function resetArrayField($key)
    {
        unset(self::$_errors[$key]);
    }
}