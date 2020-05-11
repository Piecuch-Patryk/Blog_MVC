<?php

namespace Classes;

class Input
{    
    /**
     * get      Gets value from global $_POST by given name.
     *
     * @param  string $name
     * @return string value||empty string
     */
    public static function get(string $name)
    {
        if(isset($_POST[$name])) return $_POST[$name];
        else return '';
    }
    
    /**
     * getSafe      Sanitize string - convert to html entities.
     *
     * @param  mixed $name
     * @return string value||empty string
     */
    public static function getSafe(string $name)
    {
        return htmlentities(self::get($name), ENT_SUBSTITUTE);
    }
    
    /**
     * getAll   Gets all values from global $_POST method
     *
     * @return array $values
     */
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