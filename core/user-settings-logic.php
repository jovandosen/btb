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

        // verify current password
        echo 'Well and Good';

    } else {
        header('Location: user-settings.php');
        exit();
    }

}