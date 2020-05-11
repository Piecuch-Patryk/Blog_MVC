<?php

namespace Classes;

use Classes\Session;
use Classes\Redirect;

class Auth
{    
    /**
     * setLogged        Set $_SESSION['logged'] = true.
     *
     */
    public static function setLogged()
    {
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
    
    /**
     * destroyLogin     Destroys $_SESSION and redirects to home page.
     *
     */
    public static function destroyLogin()
    {
        Session::destroy();
        Redirect::to('home');
    }
}