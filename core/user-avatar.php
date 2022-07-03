<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

if(isset($_POST['upload'])){

    $avatarSize = $_FILES['avatar']['size'];

    // var_dump($avatarSize);
    // exit();

    if($avatarSize > 10485760){
        $_SESSION['upload_error'] = 'Uploaded file is to large.';
        header(ABSPATH . 'profile.php');
        die();
    }

    //

    $avatarName = $_FILES['avatar']['name'];

    $avatarInfo = pathinfo($avatarName);
    
    $avatarExtension = $avatarInfo['extension'];

    var_dump($avatarExtension);

}