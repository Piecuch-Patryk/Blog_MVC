<?php

namespace Models;

use Classes\Input;

class Comment extends Model
{
    private $_table = 'comment';
    

    public function get(int $post_id)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM `$this->_table` WHERE `post_id` = :post_id");
        $stmt->execute([
            ':post_id' => $post_id,
        ]);
        return $stmt->fetchAll();
    }

    /**
     * store    Stores comment in database.
     *
     * @return bool
     */
    public function store()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO `$this->_table` (`name`, `body`, `post_id`) VALUES (:name, :body, :post_id)");
        return $stmt->execute([
            ':name' => Input::getSafe('name'),
            ':body' => Input::getSafe('body'),
            ':post_id' => Input::getSafe('post_id'),
        ]);
    }
}