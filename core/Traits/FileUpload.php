<?php

namespace App\Traits;

trait FileUpload
{
    public function processFileUpload($type, $inputName)
    {
        $redirectLocation = '';
        $sessionName = '';

        switch($type){
            case "user":
                $redirectLocation = 'profile.php';
                $sessionName = 'user_avatar';
                break;
            case "post":
                $redirectLocation = 'post.php';
                $sessionName = 'post_thumbnail';
                break;
            default:
                $redirectLocation = 'index.php';
                $sessionName = 'default';
        }

        // get file size
        $avatarSize = $_FILES[$inputName]['size'];

        // file size validation
        if(empty($avatarSize)){
            $_SESSION['upload_error'] = 'Please upload your file.';
            header('Location: ' . $redirectLocation);
            exit();
        }

        if($avatarSize > 10485760){
            $_SESSION['upload_error'] = 'Uploaded file is to large.';
            header('Location: ' . $redirectLocation);
            exit();
        }

        // error check, any value but 0 is bad
        if($_FILES[$inputName]['error'] !== 0){
            $_SESSION['upload_error'] = 'Sorry, error occurred during file upload.';
            header('Location: ' . $redirectLocation);
            exit();
        }

        // get file name
        $avatarName = $_FILES[$inputName]['name'];

        // file info
        $avatarInfo = pathinfo($avatarName);

        // define allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // uploaded file extension
        $avatarExtension = $avatarInfo['extension'];

        // check extension
        if(!in_array($avatarExtension, $allowedExtensions)){
            $_SESSION['upload_error'] = 'Wrong file type. Only jpg, jpeg, png and gif allowed.';
            header('Location: ' . $redirectLocation);
            exit();
        }

        // temporary file name
        $avatarTmpName = $_FILES[$inputName]['tmp_name'];

        $avatarName = basename($_FILES[$inputName]['name']);

        $avatarDestination = UPLOADS . $avatarName;

        // check if avatar exists
        if(file_exists($avatarDestination)){
            $newAvatarName = hash('sha256', $avatarName . strval(time()));
            $avatarName = $newAvatarName . '.' . $avatarExtension;
            $avatarDestination = UPLOADS . $avatarName;
        }

        if(move_uploaded_file($avatarTmpName, $avatarDestination)){
            // success
            // set data to session
            $_SESSION[$sessionName] = $avatarName;
            return $avatarName;
        } else {
            // error
            return false;
        }
    }
}