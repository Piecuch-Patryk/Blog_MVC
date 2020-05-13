<?php

namespace Models;

use Classes\Input;

class Post extends Model
{
    private $_table = 'post';

    public function __construct()
    {
        parent::__construct();
    }

    public function get(string $where, $value)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM `$this->_table` WHERE `$where` = :value ORDER BY created_at DESC");
        $stmt->execute([
            ':value' => $value,
        ]);
        return $stmt->fetchAll();
    }
    
    /**
     * getAll   Gets all posts.
     *
     * @return bool||array  $posts
     */
    public function getAll()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT * FROM `$this->_table` ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * store    Stores created post in database.
     *
     * @param int   $id
     * @return bool
     */
    public function store(int $user_id)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO `$this->_table` (`id`, `title`, `body`, `user_id`, `category_id`) VALUES (NULL, :title, :body, :userid, :category_id)");
        return $stmt->execute([
            ':title' => Input::get('title'),
            ':body' => Input::get('body'),
            ':category_id' => Input::get('category'),
            ':userid' => $user_id,
        ]);
    }
    
    /**
     * update   Updates a post by post_id.
     *
     * @return bool
     */
    public function update()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("UPDATE `$this->_table` SET `title` = :title, `body` = :body, `category_id` = :category_id WHERE `id` = :id");
        return $stmt->execute([
            ':title' => Input::getSafe('title'),
            ':body' => Input::getSafe('body'),
            ':category_id' => Input::getSafe('category'),
            ':id' => Input::getSafe('post_id'),
        ]);
    }
    
    /**
     * destroy  Destroys resource by given id.
     *
     * @param  int $id
     * @return bool
     */
    public function destroy($id)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("DELETE FROM `$this->_table` WHERE `id` = :id ");
        return $stmt->execute([
            ':id' => $id,
        ]);
    }
}