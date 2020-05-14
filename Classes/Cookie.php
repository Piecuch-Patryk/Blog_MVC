<?php

namespace Classes;

class Cookie
{    
    /**
     * set      Sets cookie by given key with given value.
     *
     * @param  string $key
     * @param  mixed $value
     */
    public static function set(string $key, $value)
    {
        setcookie($key, $value, time() + (60*60*24*30), '/');
    }
    
    /**
     * get      Gets cokie by given key if exists.
     *
     * @param  string $key
     * @return string   cookie||empty string
     */
    public static function get(string $key)
    {
        if (isset($_COOKIE[$key])) return $_COOKIE[$key];
        else return '';
    }
    
    /**
     * destroy      Deletes cookie by given key.
     *
     * @param  string $key
     */
    public static function destroy(string $key)
    {
        if (isset($_COOKIE[$key])) {
            setcookie($key, '', time() - 3600, '/');
            unset($_COOKIE[$key]);
        }
    }
}