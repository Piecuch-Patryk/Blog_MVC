<?php

namespace Classes;

class Redirect
{    
    /**
     * to       Redirects to specified location.
     *
     * @param  str $fileName
     */
    public static function to(string $fileName)
    {
        $fileName = ($fileName === 'home') ? '' : $fileName;
        $path = APP_URL . $fileName;
        header("Location: $path");
        exit;
    }
}
