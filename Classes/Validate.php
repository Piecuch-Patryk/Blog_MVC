<?php

namespace Classes;

use Classes\Input;

class Validate
{
    private static $_errors = [];

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
}