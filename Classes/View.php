<?php

namespace Classes;

use Classes\Url;

class View
{    
    /**
     * __construct      Instantiates Url class to use within this class.
     *
     */
    public function __construct()
    {
        $this->url = new Url();
    }    
    /**
     * render   Renders view by given name.
     *
     * @param  string $name [folder/file name]
     */
    public function render(string $name)
    {
        $this->content = $name;
        require 'views/layout.php';
    }
}