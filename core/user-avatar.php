<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require_once(ABSPATH . 'vendor/autoload.php');

use App\Models\User;

// if upload button is clicked
if(isset($_POST['upload'])){

    $user = new User();

    $avatarName = $user->upload();

    if($avatarName === false){
        $_SESSION['upload_error'] = 'Sorry, file not uploaded.';
        header('Location: profile.php');
        exit();
    }
        
    $result = $user->avatar($avatarName);
    
    if($result){
        $_SESSION['upload_success'] = 'File uploaded successfully.';
        // redirect to profile
        header('Location: profile.php');
        // kill the script
        exit();
    } else {
        $_SESSION['upload_error'] = 'Sorry, file not uploaded.';
        header('Location: profile.php');
        exit();
    }

}