<?php

namespace Classes;

class Session
{    
    /**
     * init     Initializes $_SESSION.
     *
     */
    public static function init()
    {
        if(!isset($_SESSION)) session_start();
    }
    
    /**
     * set      Sets $_SESSION for given key & value.
     *
     * @param  string   $key
     * @param  mixed    $value
     */
    public static function set(string $key, $value)
    {
        self::init();
        $_SESSION[$key] = $value;
    }
    
    /**
     * setMany      Sets many $_SESSION for given array[$key => $value].
     *
     * @param  array $data
     */
    public static function setMany(array $data)
    {
        self::init();
        foreach ($data as $key => $value) {
            self::set($key, $value);
        }
    }
    
    /**
     * get      Gets $_SESSION value by given key.
     *
     * @param  string   $key
     * @return mixed    $_SESSION[$key] || false
     */
    public static function get(string $key)
    {
        self::init();
        if(isset($_SESSION[$key])) return $_SESSION[$key];
        else return false;
    }
    
    /**
     * check    Checks if $_SESSION's variable value equals to given value.
     *
     * @param  string   $key
     * @param  mixed    $value
     * @return mixed    bool
     */
    public static function check(string $key, $value)
    {
        self::init();
        if(isset($_SESSION[$key])) return $_SESSION[$key] === $value;
    }
    
    /**
     * destroy  Destroys current session.
     *
     */
    public static function destroy()
    {
        self::init();
        session_destroy();
    }
}