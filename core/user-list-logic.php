<?php

    // start the session
    session_start();

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

        // remove all session variables and destroy session
        session_unset();
        session_destroy();
    }

?>