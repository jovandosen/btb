<?php

// start the session
session_start();

require_once('../config.php');

require(ABSPATH . 'db.php');

// check if user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['change-password'])){

    unset($_POST['change-password']);

    $error = false;

    foreach($_POST as $k => $v){

        if(empty($_POST[$k])){

            $error = true;
            $_SESSION[$k] = 'Password field can not be empty.';

        } else {

            if(strlen($_POST[$k]) < 8){

                $error = true;
                $_SESSION[$k] = 'Password field must have at least 8 characters.';
                
            } else {

                $containsLetter  = preg_match('/[a-zA-Z]/', $_POST[$k]);
                $containsDigit   = preg_match('/\d/', $_POST[$k]);
                $containsSpecialChar = preg_match('/[^a-zA-Z\d]/', $_POST[$k]);

                if(!$containsLetter || !$containsDigit || !$containsSpecialChar){
                    $error = true;
                    $_SESSION[$k] = 'Password field must contain letters, numbers and special characters.';
                }

            }

        }

    }

    if($error === false){

        // get user password from db
        $sqlPrepareSelect = $conn->prepare("SELECT * FROM users WHERE email = ?");

        $sqlPrepareSelect->bind_param("s", $_SESSION['user_email']);

        $selectResult = $sqlPrepareSelect->execute();

        $storeResult = $sqlPrepareSelect->get_result();

        $user = $storeResult->fetch_object();

        $sqlPrepareSelect->close();

        // check if current password is correct
        $userPasswordCheck = password_verify($_POST['pass'], $user->password);

        if(!$userPasswordCheck){

            $_SESSION['pass'] = 'Password is not correct.';

            header('Location: user-settings.php');

            exit();
        }

        if($_POST['new_pass'] != $_POST['repeat_new_pass']){

            $_SESSION['repeat_new_pass'] = 'Passwords do not match.';

            header('Location: user-settings.php');

            exit();
        }

        // current date and time
        $dateTime = date('Y-m-d H:i:s');

        // prepare update query
        $sqlPrepareUpdate = $conn->prepare("UPDATE users SET password = ?, updated = ? WHERE id = ?");

        // new user password
        $newPass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);

        // bind params
        $sqlPrepareUpdate->bind_param("ssi", $newPass, $dateTime, $user->id);

        // execute update query
        $updateStatus = $sqlPrepareUpdate->execute();

        // check if update is successfull
        if($updateStatus){

            $sqlPrepareUpdate->close();

            // close db connection
            $conn->close();

            // redirect to logout script
            header('Location: logout.php');

            // kill the script
            exit();

        }

    } else {
        header('Location: user-settings.php');
        exit();
    }

}