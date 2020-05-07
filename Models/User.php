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

    public function get(string $email)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT id, name, surname, password, email, created_at FROM $this->_table WHERE `email` = :email");
        $stmt->execute([
            ':email' => $email,
        ]);
        return $stmt->fetch();
    }
    
    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        $result = $this->get($email);
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