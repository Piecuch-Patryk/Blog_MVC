<?php

namespace Classes;

class Input
{
    public static function get(string $name)
    {
        if(isset($_POST)) return $_POST[$name];
        else return '';
    }
}