<?php

    // start the session
    session_start();

    require_once('config.php');

    require_once(ABSPATH . 'vendor/autoload.php');

    use App\Models\User;

    if(isset($_SESSION['user_id'])){
        header('Location: core/profile.php');
        exit();
    }

    if(empty($_SESSION['token'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    $token = $_SESSION['token'];

    // check if register button is clicked
    if(isset($_POST['register'])){

        // collect form data using POST request method, also trim data
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // format user input
        $name = ucfirst(strtolower($name));
        $email = strtolower($email);

        // save temporary form data so user doesn't have to type over and over
        $_SESSION['temp_name'] = $name;
        $_SESSION['temp_email'] = $email;

        // set default error value
        $error = false;

        // form validation
        if(empty($name)){
            $error = true;
            $_SESSION['name_error'] = 'Name can not be empty.';
        } else {
            if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                $error = true;
                $_SESSION['name_error'] = 'Name can contain only letters and white spaces.';
            }
        }

        if(empty($email)){
            $error = true;
            $_SESSION['email_error'] = 'Email can not be empty.';
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = true;
                $_SESSION['email_error'] = 'Email is not valid.';
            }
        }

        if(empty($password)){
            $error = true;
            $_SESSION['password_error'] = 'Password can not be empty.';
        } else {

            if(strlen($password) < 8){
                $error = true;
                $_SESSION['password_error'] = 'Password must have at least 8 characters.';
            } else {

                $containsLetter  = preg_match('/[a-zA-Z]/', $password);
                $containsDigit   = preg_match('/\d/', $password);
                $containsSpecialChar = preg_match('/[^a-zA-Z\d]/', $password);

                if(!$containsLetter || !$containsDigit || !$containsSpecialChar){
                    $error = true;
                    $_SESSION['password_error'] = 'Password must contain letters, numbers and special characters.';
                }

            }
        }

        if(!empty($_POST['token'])){
            if(!hash_equals($_SESSION['token'], $_POST['token'])){
                $error = true;
                $_SESSION['token_error'] = 'Form request invalid.';
            }
        }

        // if there are no validation errors
        if($error === false){

            $user = new User($name, $email, $password);

            // check if email already exists
            $user->isEmailTaken();

            // store user
            $created = $user->create();

            var_dump($created);

            die('the end');

            // set user data in session
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_role'] = $role;

            // close connection
            // $conn->close();

            // set successfull registration message
            $_SESSION['register_message'] = 'You have successfully registered.';

            // redirect to profile page
            header('Location: core/profile.php');

            // kill the script
            exit();

        }
    }

?>