<?php

namespace Models;

class Category extends Model
{
    private $_table = 'category';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * getAll   Retrieves all categories from database.
     *
     * @return bool||array  $categories
     */
    public function getAll()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM `$this->_table`");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}