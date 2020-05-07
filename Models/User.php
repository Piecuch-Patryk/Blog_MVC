<?php

namespace Models;

use Classes\Hash;
use Classes\Session;
use Classes\Input;

class User extends Model
{
    private $_table = 'user';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * get      Gets user from database.
     *
     * @param  string $where
     * @param  string $value
     * @return false||array     $array with query result.
     */
    public function get(string $where, string $value)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT id, name, surname, password, email, role, created_at FROM $this->_table WHERE `$where` = :value");
        $stmt->execute([
            ':value' => $value,
        ]);
        return $stmt->fetch();
    }
    
    /**
     * getAll   Gets all users from database.
     *
     * @return bool||array  $array with query result.
     */
    public function getAll()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT `id`, `name`, `surname`, `email`, `role`, `created_at` FROM `$this->_table` ORDER BY `created_at` DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
        
    /**
     * login    Retrieves user by given login and compares password's hash with given one.
     *
     * @return false||array $array with query result. 
     */
    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        $result = $this->get('email', $email);
        Session::init();

        if($result) {
            if(Hash::verify($password, $result['password'])) {
                unset($result['password']);
                Session::set('logged', true);
                $result['fullName'] = $result['name'] . ' ' . $result['surname'];
                Session::setMany($result);
                return $result;
            }
        }

        Session::set('error', 'Incorrect email or password.');
        return false;
    }
    
    /**
     * store    Stores created user in database.
     *
     * @return bool
     */
    public function store()
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO `$this->_table` (`id` , `name`, `surname`, `email`, `password`, `role`) VALUES (NULL, :name, :surname, :email, :password, :role)");
        return $result = $stmt->execute([
            ':name' => Input::get('name'),
            ':surname' => Input::get('surname'),
            ':email' => Input::get('email'),
            ':password' => Hash::get(Input::get('password')),
            ':role' => Input::get('role'),
            ]);
    }

}