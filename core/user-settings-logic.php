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

    $error = false;

    foreach($_POST as $k => $v){

        if(empty($_POST[$k])){
            $error = true;
            $_SESSION[$k] = 'Password field can not be empty.';
        }

    }

    if($error === false){
        echo 'ok';
    } else {
        header('Location: user-settings.php');
        exit();
    }

}