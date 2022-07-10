<?php

namespace App\Models;

use App\Models\DbModel;

class User extends DbModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;

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
            $this->role = "user";

            // bind user input fields, bind_param function returns true or false
            $binded = $prepared->bind_param("sssssss", $this->name, $this->email, $this->password, $this->role, $dateTime, $dateTime, $dateTime);

            // if params are binded
            if($binded){
                // run query, execute function returns true or false
                $executed = $prepared->execute();

                // if executed
                if($executed){
                    // close prepared statement
                    $prepared->close();

                    // get user id
                    $this->id = $this->conn->insert_id; 

                    // close db connection
                    $this->conn->close();

                    return [
                        'id' => $this->id,
                        'name' => $this->name,
                        'email' => $this->email,
                        'role' => $this->role
                    ];
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

    public function login()
    {
        // prepare sql query, prepare function returns object or false
        $prepared = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        // if query is prepared
        if($prepared){
            // bind user input fields, bind_param function returns true or false
            $binded = $prepared->bind_param("s", $this->email);

            if($binded){
                // run query, execute function returns true or false
                $executed = $prepared->execute();

                // if executed
                if($executed){
                    // get result, in this select case, get_result function returns object or false
                    $result = $prepared->get_result();

                    // result object exists
                    if($result){
                        // fetch user data, fetch_object function returns object, null or false
                        $user = $result->fetch_object();

                        // if user data successfully returned
                        if($user){
                            // close prepared statement
                            $prepared->close();

                            // check if password is correct
                            $userPasswordCheck = password_verify($this->password, $user->password);

                            if(!$userPasswordCheck){

                                $_SESSION['password_error'] = 'Password is not correct.';
                            
                                header('Location: login.php');
                            
                                exit();
                            }

                            $this->lastLogin($user);

                            // set successfull login message
                            $_SESSION['login_message'] = 'Welcome back.';

                            // set user data to session
                            $_SESSION['user_id'] = $user->id;
                            $_SESSION['user_name'] = $user->name;
                            $_SESSION['user_email'] = $user->email;
                            $_SESSION['user_role'] = $user->role;
                            $_SESSION['user_avatar'] = $user->avatar;

                            // redirect to profile page
                            header('Location: core/profile.php');

                            // kill the script
                            exit();

                        } else {
                            $_SESSION['email_error'] = 'Email address not found.';
                            header('Location: login.php');
                            exit();
                        }
                    } else {
                        return false;
                    }
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

    private function lastLogin($user)
    {
        // current date and time
        $dateTime = date('Y-m-d H:i:s');

        // update last login column in db
        $result = $this->conn->query("UPDATE users set last_login = '$dateTime' WHERE id = '$user->id'");

        // close db connection
        $this->conn->close();
    }
}