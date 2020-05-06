<?php

namespace Classes;

class Session
{
    public static function init()
    {
        session_start();
    }

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function setMany(array $data)
    {
        foreach ($data as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function get(string $key)
    {
        if(isset($_SESSION[$key])) return $_SESSION[$key];
        else return false;
    }

    public static function check(string $key, $value)
    {
        if(isset($_SESSION[$key])) return $_SESSION[$key] === $value;
    }

    public static function destroy()
    {
        session_destroy();
    }
}