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

    // error check, any value but 0 is bad
    if($_FILES['avatar']['error'] !== 0){
        $_SESSION['upload_error'] = 'Sorry, error occurred during file upload.';
        header('Location: profile.php');
        exit();
    }

    // get file name
    $avatarName = $_FILES['avatar']['name'];

    // file info
    $avatarInfo = pathinfo($avatarName);
    
    // define allowed file extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // uploaded file extension
    $avatarExtension = $avatarInfo['extension'];

    // check extension
    if(!in_array($avatarExtension, $allowedExtensions)){
        $_SESSION['upload_error'] = 'Wrong file type. Only jpg, jpeg, png and gif allowed.';
        header('Location: profile.php');
        exit();
    }

    // temporary file name
    $avatarTmpName = $_FILES['avatar']['tmp_name'];

    $avatarName = basename($_FILES['avatar']['name']);

    $avatarDestination = UPLOADS . $avatarName;

    // check if avatar exists
    if(file_exists($avatarDestination)){
        $newAvatarName = hash('sha256', $avatarName . strval(time()));
        $avatarName = $newAvatarName . '.' . $avatarExtension;
        $avatarDestination = UPLOADS . $avatarName;
    }

    if(move_uploaded_file($avatarTmpName, $avatarDestination)){
        // success
        // update avatar value in db
        $avatarUpdateResult = $conn->query("UPDATE users SET avatar = '$avatarName' WHERE id = '".$_SESSION['user_id']."'");

        // close db connection
        $conn->close();

        // set data to session
        $_SESSION['user_avatar'] = $avatarName;
        $_SESSION['upload_success'] = 'File uploaded successfully.';

        // redirect to profile
        header('Location: profile.php');

        // kill the script
        exit();
    } else {
        // error
        $_SESSION['upload_error'] = 'Sorry, file not uploaded.';
        header('Location: profile.php');
        exit();
    }

}