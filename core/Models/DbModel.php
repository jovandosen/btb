<?php

namespace App\Models;

class DbModel
{
    protected $conn;

    public function __construct()
    {
        // create db connection
        $this->conn = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // check if there are any db connection errors
        if($this->conn->connect_errno){
            echo "Failed to connect to MySQL: " . $this->conn->connect_error;
            exit();
        }
    }
}