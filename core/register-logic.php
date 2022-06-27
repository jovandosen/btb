<?php

    // start the session
    session_start();

    if(empty($_SESSION['token'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    $token = $_SESSION['token'];

    // function that writes to session log file
    function writeSessionLogMsg($msg)
    {
        $myfile = fopen("session.log", "a") or die("Unable to open file!");
        $txt = "$msg\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    // clearstatcache();
    // echo substr(sprintf('%o', fileperms('session.log')), -4);
    // die();

    // var_dump(posix_getpwuid(fileowner('session.log')));
    // die();

    // write session token message
    $message = "Initial token value: " . $token;
    writeSessionLogMsg($message);
    // die();

    // check if successfull registration message exists
    if(isset($_SESSION['register_message'])){

        echo "<div id='flash-msg-el' class='flash-msg-box flash-success'>" . $_SESSION['register_message'] . "</div>";

        // remove all session variables and destroy session
        session_unset();
        session_destroy();

        $_SESSION['token'] = bin2hex(random_bytes(32));

        $token = $_SESSION['token'];

        // echo $token;
    }

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

            // create db connection
            $conn = new mysqli("localhost", "jovan", "protector-994", "btb");

            // check if there are any db connection errors
            if($conn->connect_errno){
                echo "Failed to connect to MySQL: " . $conn->connect_error;
                exit();
            }

            // prepare sql query
            $sqlPrepare = $conn->prepare("INSERT INTO users(name, email, password, created, updated) VALUES(?, ?, ?, ?, ?)");

            // hash the user password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // current date and time
            $dateTime = date('Y-m-d H:i:s');

            // bind user input fields
            $sqlPrepare->bind_param("sssss", $name, $email, $password, $dateTime, $dateTime);

            // run query
            $sqlPrepare->execute();

            // close prepared statement
            $sqlPrepare->close();

            // close connection
            $conn->close();

            // set successfull registration message
            $_SESSION['register_message'] = 'New record successfully added to database.';

            // redirect back to same page, to reset HTTP state
            header('Location: register.php');

            // kill the script
            exit();

        }
    }

?>