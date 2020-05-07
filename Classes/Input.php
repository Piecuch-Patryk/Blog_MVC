<?php

namespace Classes;

class Input
{
    public static function get(string $name)
    {
        if(isset($_POST)) return $_POST[$name];
        else return '';
    }

    public static function getAll()
    {
        $values = [];
        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                if ($key !== 'password' && $key !== 'password-repeat')
                $values[$key] = $value;
            }
            return $values;
        }
    }
}