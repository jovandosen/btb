<?php

namespace App\Models;

use App\Models\DbModel;

class User extends DbModel
{
    private $name;
    private $email;
    private $password;

    public function __construct($name, $email, $password)
    {
        parent::__construct();

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function create()
    {
        // prepare sql query, prepare function returns object or false
        $prepared = $this->conn->prepare("INSERT INTO users(name, email, password, role, last_login, created, updated) VALUES(?, ?, ?, ?, ?, ?, ?)");

        // if query is prepared
        if($prepared){
            // hash the user password
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

            // current date and time
            $dateTime = date('Y-m-d H:i:s');

            // user role
            $role = "user";

            // bind user input fields, bind_param function returns true or false
            $binded = $prepared->bind_param("sssssss", $this->name, $this->email, $this->password, $role, $dateTime, $dateTime, $dateTime);

            // if params are binded
            if($binded){
                // run query, execute function returns true or false
                $executed = $prepared->execute();

                // if executed
                if($executed){
                    // close prepared statement and db connection
                    $prepared->close();
                    $this->conn->close();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function isEmailTaken()
    {
        $emails = $this->conn->query("SELECT email FROM users");

        while($emailFragment = $emails->fetch_object()){
            if($emailFragment->email == $this->email){
                $_SESSION['email_error'] = 'Email address already exists.';
                header('Location: register.php');
                die();
            }
        }
    }
}