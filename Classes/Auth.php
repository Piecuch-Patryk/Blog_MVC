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
        Session::init();
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
    }
    
    /**
     * destroyLogin     Destroys $_SESSION and redirects to home page.
     *
     * @return void
     */
    public static function destroyLogin()
    {
        Session::destroy();
        Redirect::to('home');
    }
}