<?php

    // start the session
    session_start();

    require_once(__DIR__ . '/../config.php');

    require(ABSPATH . 'db.php');

    // check if delete user button is clicked
    if(isset($_POST['delete'])){

        $id = $_POST['userID'];

        // prepare sql delete query
        $sqlPrepareDelete = $conn->prepare("DELETE FROM users WHERE id = ?");

        // bind id
        $sqlPrepareDelete->bind_param("d", $id);

        // execute delete query
        $deleteResult = $sqlPrepareDelete->execute();

        // if delete is successfull
        if($deleteResult){

            $sqlPrepareDelete->close();

            // close connection
            $conn->close();

            // put delete message in session
            $_SESSION['user_deleted'] = 'User successfully deleted.';

            // redirect to user list
            header('Location: user-list.php');

            // kill the script
            exit();

        }

    }

?>