<?php

namespace Classes;

class Url
{    
    /**
     * to       Creates link to specified location.
     *
     * @param  string $location
     * @return string $url
     */
    public function to(string $location)
    {
        return ($location === 'home') ? '' : APP_URL . $location;
    }
}
