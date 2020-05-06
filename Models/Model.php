<?php

namespace Models;

use Classes\Database;

class Model
{
    public function __construct()
    {
        $this->db = new Database();
    }
}