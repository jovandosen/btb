<?php

// start the session
session_start();

require_once('../config.php');

require_once(ABSPATH . 'vendor/autoload.php');

use App\Models\User;

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
        $userObj = new User();

        $user = $userObj->getUserByEmail($_SESSION['user_email']);

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

        $userObj = new User();

        $userObj->changePassword($_POST['new_pass'], $user);

    } else {
        header('Location: user-settings.php');
        exit();
    }

}