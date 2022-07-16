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
    if(isset($_POST['login'])){

        // collect form data using POST request method, also trim data
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // format user input
        $email = strtolower($email);

        // save temporary form data so user doesn't have to type over and over
        $_SESSION['temp_email'] = $email;

        // set default error value
        $error = false;

        // form validation
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
            // create user object and db connection
            $user = new User('', $email, $password);

            if(isset($_POST['remember']) && $_POST['remember'] == 'yes'){
                $rememberMe = $_POST['remember'];
            }

            // log user
            $user->login();
        }
    }

?>