<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require_once(ABSPATH . 'vendor/autoload.php');

use App\Models\User;

// if upload button is clicked
if(isset($_POST['upload'])){

    $user = new User();

    $user->upload();
        
    $user->avatar($_SESSION['user_avatar']);   

}