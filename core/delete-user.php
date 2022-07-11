<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require_once(ABSPATH . 'vendor/autoload.php');

use App\Models\User;

// check if delete user button is clicked
if(isset($_POST['delete'])){

    $id = $_POST['userID'];

    $user = new User();

    $deleteResult = $user->deleteUserById($id);

    // if delete is successfull
    if($deleteResult){

        // put delete message in session
        $_SESSION['user_deleted'] = 'User successfully deleted.';

        // redirect to user list
        header('Location: user-list.php');

        // kill the script
        exit();

    }

}

?>