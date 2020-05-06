<?php

namespace Classes;

class Hash
{
    public static function verify(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}