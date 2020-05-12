<?php

namespace Classes;

class Cookie
{
    public static function set(string $key, $value)
    {
        setcookie($key, $value, time() + (60*60*24*30), '/');
    }

    public static function get($key)
    {
        if (isset($_COOKIE[$key])) return $_COOKIE[$key];
        else return '';
    }

    public static function destroy(string $key)
    {
        if (isset($_COOKIE[$key])) {
            setcookie($key, '', time() - 3600, '/');
            unset($_COOKIE[$key]);
        }
    }
}