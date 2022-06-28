<?php

    // start the session
    session_start();

    if(empty($_SESSION['token'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    $token = $_SESSION['token'];

    // check if successfull registration message exists
    if(isset($_SESSION['login_message'])){
        echo "<div id='flash-msg-el' class='flash-msg-box flash-success'>" . $_SESSION['login_message'] . "</div>";
        unset($_SESSION['login_message']);
    }

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

            // create db connection
            $conn = new mysqli("localhost", "jovan", "protector-994", "btb");

            // check if there are any db connection errors
            if($conn->connect_errno){
                echo "Failed to connect to MySQL: " . $conn->connect_error;
                exit();
            }

            $sqlPrepareSelect = $conn->prepare("SELECT * FROM users WHERE email = ?");

            $sqlPrepareSelect->bind_param("s", $email);

            $selectResult = $sqlPrepareSelect->execute();

            var_dump($selectResult);

            // set successfull login message
            $_SESSION['login_message'] = 'Welcome back.';

        }
    }

?>