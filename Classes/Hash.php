<?php

namespace Classes;

class Hash
{

    public static function get(string $string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    public static function verify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}