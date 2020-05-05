<?php

namespace Controllers;

class Post extends Controller
{
    public function __construct()
    {
        echo 'Post controller';
    }

    public function all()
    {
        echo 'All Posts!';
    }
}