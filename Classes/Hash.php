<?php

namespace Classes;

class Hash
{
    
    /**
     * get      Creates hashed string from given string.
     *
     * @param  string $string
     * @return string $hash
     */
    public static function get(string $string)
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }
    
    /**
     * verify   Verifies given password with given hash.
     *
     * @param  string $password
     * @param  string $hash
     * @return bool
     */
    public static function verify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}