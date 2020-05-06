<?php

namespace Models;

class Post extends Model
{
    public function __construct()
    {
        parent::__construct();
        echo 'post model <br>';
    }
}