<?php

namespace App\Models;

use App\Models\DbModel;
use App\Traits\FileUpload;
use stdClass;

class User extends DbModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;

    use FileUpload;

    public function __construct($name = '', $email = '', $password = '')
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

    public function all()
    {
        $users = $this->conn->query("SELECT * FROM users");

        $this->conn->close();

        return $users;
    }

    public function paginate($perPage = 5, $currentPage = 1)
    {
        $offset = ($perPage * $currentPage) - $perPage;

        $users = $this->conn->query("SELECT * FROM users LIMIT $perPage OFFSET $offset");

        $this->conn->close();

        return $users;
    }

    public function avatar($avatarName)
    {
        // update avatar value in db
        $avatarUpdateResult = $this->conn->query("UPDATE users SET avatar = '$avatarName' WHERE id = '".$_SESSION['user_id']."'");
        // close db connection
        $this->conn->close();

        return $avatarUpdateResult;
    }

    public function upload()
    {
        $fileUploadResult = $this->processFileUpload('user', 'avatar');
        return $fileUploadResult;
    }

    public function getUserByEmail($email)
    {
        $prepared = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        if($prepared){

            $binded = $prepared->bind_param("s", $_SESSION['user_email']);

            if($binded){

                $executed = $prepared->execute();

                if($executed){

                    $result = $prepared->get_result();

                    if($result){

                        $user = $result->fetch_object();

                        if($user){

                            $prepared->close();

                            return $user;

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

        } else {
            return false;
        }
    }

    public function changePassword($newPassword, $user)
    {
        // prepare update query
        $prepared = $this->conn->prepare("UPDATE users SET password = ?, updated = ? WHERE id = ?");

        // current date and time
        $dateTime = date('Y-m-d H:i:s');

        // new user password
        $newPass = password_hash($newPassword, PASSWORD_DEFAULT);

        if($prepared){

            // bind params
            $binded = $prepared->bind_param("ssi", $newPass, $dateTime, $user->id);

            if($binded){

                // execute update query
                $executed = $prepared->execute();

                if($executed){

                    $prepared->close();

                    // close db connection
                    $this->conn->close();

                    // redirect to logout script
                    header('Location: logout.php');

                    // kill the script
                    exit();

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

    public function getUserById($id)
    {
        // find user by id
        $prepared = $this->conn->prepare("SELECT name, email, role FROM users WHERE id = ?");

        if($prepared){

            $binded = $prepared->bind_param("i", $id);

            if($binded){

                $executed = $prepared->execute();

                if($executed){

                    $result = $prepared->get_result();

                    if($result){

                        $u = $result->fetch_object();

                        $prepared->close();

                        $this->conn->close();

                        return $u;

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

    public function getAllEmails($email)
    {
        $prepared = $this->conn->prepare("SELECT email FROM users WHERE email != ?");

        $emails = [];

        if($prepared){

            $binded = $prepared->bind_param("s", $email);

            if($binded){

                $executed = $prepared->execute();

                if($executed){

                    $bindedResult = $prepared->bind_result($e);

                    if($bindedResult){

                        while($prepared->fetch()){
                            $emails[] = $e;
                        }

                        $prepared->close();

                        $this->conn->close();

                        return $emails;

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

    public function updateDetails($details)
    {
        // current date and time
        $dateTime = date('Y-m-d H:i:s');

        // proceed update
        $prepared = $this->conn->prepare("UPDATE users SET name = ?, email = ?, role = ?, updated = ? WHERE id = ?");

        if($prepared){

            $binded = $prepared->bind_param("ssssi", $details['name'], $details['email'], $details['role'], $dateTime, $details['id']);

            if($binded){

                $executed = $prepared->execute();

                if($executed){

                    $prepared->close();

                    $this->conn->close();

                    return $executed;
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

    public function deleteUserById($id)
    {
        // prepare sql delete query
        $prepared = $this->conn->prepare("DELETE FROM users WHERE id = ?");

        if($prepared){

            // bind id
            $binded = $prepared->bind_param("d", $id);

            if($binded){

                // execute delete query
                $executed = $prepared->execute();

                if($executed){

                    $prepared->close();

                    // close connection
                    $this->conn->close();

                    return $executed;
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

    public function search($term)
    {
        $prepared = $this->conn->prepare("SELECT id, name, email, created, updated FROM users WHERE name LIKE ? OR email LIKE ? OR role LIKE ?");

        $users = [];

        if($prepared){

            $prepareTerm = '%' . $term .  '%';

            $binded = $prepared->bind_param("sss", $prepareTerm, $prepareTerm, $prepareTerm);

            if($binded){

                $executed = $prepared->execute();

                if($executed){

                    $bindedResult = $prepared->bind_result($i, $n, $e, $c, $u);

                    if($bindedResult){
                        
                        while($prepared->fetch()){

                            $userObject = new stdClass();

                            $userObject->id = $i;
                            $userObject->name = $n;
                            $userObject->email = $e;
                            $userObject->created = $c;
                            $userObject->updated = $u;

                            $users[] = $userObject;
                        
                        }

                        $prepared->close();

                        $this->conn->close();

                        return $users;

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
}