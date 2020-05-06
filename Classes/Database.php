<?php

namespace Classes;

use PDO;

class Database
{
    private $_dsn = 'mysql:dbname=blog_mvc;host=localhost';
    private $_user = 'root';
    private $_password = '';
    private $_connection;

    public function connect()
    {
        try {
            $this->_connection = new PDO($this->_dsn, $this->_user, $this->_password);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMesage();
        }
        return $this->_connection;
    }
}