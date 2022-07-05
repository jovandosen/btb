<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

if(isset($_POST['update'])){

    // collect form data using POST request method, also trim data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);

    // format user input
    $name = ucfirst(strtolower($name));
    $email = strtolower($email);
    $role = strtolower($role);

    // set default error value
    $error = false;

    // form validation
    if(empty($name)){
        $error = true;
        $_SESSION['name_error'] = 'Name can not be empty.';
    } else {
        if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
            $error = true;
            $_SESSION['name_error'] = 'Name can contain only letters and white spaces.';
        }
    }

    if(empty($email)){
        $error = true;
        $_SESSION['email_error'] = 'Email can not be empty.';
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = true;
            $_SESSION['email_error'] = 'Email is not valid.';
        }
    }

    if(empty($role)){
        $error = true;
        $_SESSION['role_error'] = 'Role can not be empty.';
    } else {
        if($role != 'user' && $role != 'admin'){
            $error = true;
            $_SESSION['role_error'] = 'Role can be user or admin';
        }
    }

    if($error === false){

        $sqlPrepareSelect = $conn->prepare("SELECT email FROM users WHERE email != ?");

        $sqlPrepareSelect->bind_param("s", $_SESSION['user_email']);

        $sqlPrepareSelect->execute();

        $sqlPrepareSelect->bind_result($e);

        while($sqlPrepareSelect->fetch()){
            if($email == $e){
                $_SESSION['email_error'] = 'Email address already exists.';
                header('Location: user-edit.php');
                exit();
            }
        }

        $sqlPrepareSelect->close();

        // proceed update
        $sqlPrepareUpdate = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");

        $sqlPrepareUpdate->bind_param("sssd", $name, $email, $role, $_SESSION['user_id']);

        $updateStatus = $sqlPrepareUpdate->execute();

        if($updateStatus){

            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $role;

            $_SESSION['update_message'] = 'You have successfully updated your data.';

            $sqlPrepareUpdate->close();

            $conn->close();

            header('Location: user-edit.php');
            exit();

        }

    } else {
        header('Location: user-edit.php');
        exit();
    }

}