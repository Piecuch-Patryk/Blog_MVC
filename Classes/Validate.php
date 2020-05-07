<?php

namespace Classes;

use Classes\Input;

class Validate
{
    private static $_errors = [];

    public static function request()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

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

        if (empty($email)) self::$_errors['email'] = 'Email address required.';
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) self::$_errors['email'] = 'Provide correct email address.';
    }

    private static function password()
    {
        $password = Input::get('password');
        if (empty($password)) self::$_errors['password'] = 'Password required.';
    }

    private static function name()
    {
        $name = Input::get('name');
        if  (empty($name)) self::$_errors['name'] = 'Name required.';
        else if (!ctype_alpha($name)) self::$_errors['name'] = 'Name can only contains letters.';
    }

    private static function surname()
    {
        $name = Input::get('surname');
        if  (empty($name)) self::$_errors['surname'] = 'Surname required.';
        else if (!ctype_alpha($name)) self::$_errors['surname'] = 'Surname can only contains letters.';
    }

    private static function passwordMatch()
    {
        $password_1 = Input::get('password');
        $password_2 = Input::get('password-repeat');
        if ($password_1 !== $password_2) self::$_errors['password-repeat'] = 'Both passwords must be the same.';
    }
}