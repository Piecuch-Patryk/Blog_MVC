<?php

namespace Models;

use Classes\Database;

class Model
{    
    /**
     * __construct      Instantiate Database class to use within this class.
     *
     */
    public function __construct()
    {
        $this->db = new Database();
    }
}