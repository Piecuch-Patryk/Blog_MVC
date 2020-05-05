<?php

namespace Classes;

use Classes\Url;

class View
{
    public function __construct()
    {
        $this->url = new Url();
    }
    public function render(string $name)
    {
        $this->content = $name;
        require 'views/layout.php';
    }
}