<?php

    // start the session
    session_start();

    require_once(__DIR__ . '/../config.php');

    // check if delete user button is clicked
    if(isset($_POST['delete'])){

        $id = $_POST['userID'];

        // create db connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // check if there are any db connection errors
        if($conn->connect_errno){
            echo "Failed to connect to MySQL: " . $conn->connect_error;
            exit();
        }

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