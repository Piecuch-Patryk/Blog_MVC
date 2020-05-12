<?php

namespace Models;

use Classes\Input;
use Classes\Session;

class Post extends Model
{
    private $_table = 'post';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * getAll   Gets all posts for specified user by given user_id.
     *
     * @param  string $where
     * @param  mixed $value
     * @return bool||array  $posts
     */
    public function getAll(string $where, $value)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM `$this->_table` WHERE `$where` = :value ORDER BY created_at DESC");
        $stmt->execute([
            ':value' => $value,
        ]);
        return $stmt->fetchAll();
    }
    
    /**
     * store    Stores created post in database.
     *
     * @return bool
     */
    public function store()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO `$this->_table` (`id`, `title`, `body`, `user_id`, `category_id`) VALUES (NULL, :title, :body, :userid, :category_id)");
        return $stmt->execute([
            ':title' => Input::get('title'),
            ':body' => Input::get('body'),
            ':category_id' => Input::get('category'),
            ':userid' => Session::get('id'),
        ]);
    }

    public function destroy($id)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("DELETE FROM `$this->_table` WHERE `id` = :id ");
        return $stmt->execute([
            ':id' => $id,
        ]);
    }
}