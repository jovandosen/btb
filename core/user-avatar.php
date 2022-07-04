<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

// if upload button is clicked
if(isset($_POST['upload'])){

    // get file size
    $avatarSize = $_FILES['avatar']['size'];

    // file size validation
    if(empty($avatarSize)){
        $_SESSION['upload_error'] = 'Please upload your file.';
        header('Location: profile.php');
        exit();
    }

    if($avatarSize > 10485760){
        $_SESSION['upload_error'] = 'Uploaded file is to large.';
        header('Location: profile.php');
        exit();
    }

    // get file name
    $avatarName = $_FILES['avatar']['name'];

    // file info
    $avatarInfo = pathinfo($avatarName);
    
    // define allowed file extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    // uploaded file extension
    $avatarExtension = $avatarInfo['extension'];

    // check extension
    if(!in_array($avatarExtension, $allowedExtensions)){
        $_SESSION['upload_error'] = 'Wrong file type. Only jpg, jpeg and png allowed.';
        header('Location: profile.php');
        exit();
    }

    // temporary file name
    $avatarTmpName = $_FILES['avatar']['tmp_name'];

    $avatarDestination = UPLOADS . basename($_FILES['avatar']['name']);

    if(move_uploaded_file($avatarTmpName, $avatarDestination)){
        // success
        $_SESSION['upload_success'] = 'File uploaded successfully.';
        header('Location: profile.php');
        exit();
    } else {
        // error
        $_SESSION['upload_error'] = 'Sorry, file not uploaded.';
        header('Location: profile.php');
        exit();
    }

}