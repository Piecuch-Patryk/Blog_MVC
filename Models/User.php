<?php

namespace Models;

use Classes\Hash;
use Classes\Session;

class User extends Model
{
    private $_table = 'user';

    public function __construct()
    {
        parent::__construct();
    }
    public function login($email, $password)
    {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("SELECT id, name, surname, password, email, created_at FROM $this->_table WHERE `email` = :email");
        $stmt->execute([
            ':email' => 'admin@page.com',
        ]);
        $result = $stmt->fetch();
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

}