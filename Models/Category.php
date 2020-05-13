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
     * get      Retrieves a category by category_name.
     *
     * @param  string $name
     * @return bool||array
     */
    public function get(string $name)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM $this->_table WHERE `name` = :name");
        $stmt->execute([
            ':name' => $name,
        ]);
        return $stmt->fetch();
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