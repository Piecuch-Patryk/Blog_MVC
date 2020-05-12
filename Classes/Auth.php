<?php

namespace Classes;

use Classes\Session;
use Classes\Redirect;
use Classes\Cookie;

class Auth
{    
    /**
     * setLogged        Set $_SESSION['logged'] = true.
     *
     */
    public static function setLogged(string $login = NULL)
    {
        if ($login) Cookie::set('login', $login);
        Session::set('logged', true);
    }
    
    /**
     * checkLogin       If $_SESSION['logged] != true redirects to home page.
     *
     */
    public static function checkLogin()
    {
        Session::init();
        if(!Session::check('logged', true)) Redirect::to('home');
        else return true;
    }

    public static function checkCookie()
    {
        return isset($_COOKIE['login']) ? $_COOKIE['login'] : false;
    }
    
    /**
     * destroyLogin     Destroys $_SESSION and redirects to home page.
     *
     */
    public static function destroyLogin()
    {
        Cookie::destroy('login');
        Session::destroy();
        Redirect::to('home');
    }
}