<?php

    // start the session
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location: ../login.php');
        exit();
    }

    // create db connection
    $conn = new mysqli("localhost", "jovan", "protector-994", "btb");

    // check if there are any db connection errors
    if($conn->connect_errno){
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

    $sql = "SELECT * FROM users";

    $result = $conn->query($sql);

    if(isset($_SESSION['user_deleted'])){
        echo "<div id='flash-msg-el' class='flash-msg-box flash-error'>" . $_SESSION['user_deleted'] . "</div>";
        unset($_SESSION['user_deleted']);
    }

?>