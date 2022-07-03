<?php

    // start the session
    session_start();

    require_once(__DIR__ . '/../config.php');

    require(ABSPATH . 'db.php');

    if(!isset($_SESSION['user_id'])){
        header('Location: ../login.php');
        exit();
    }

    $sql = "SELECT * FROM users";

    $result = $conn->query($sql);

    if(isset($_SESSION['user_deleted'])){
        echo "<div id='flash-msg-el' class='flash-msg-box flash-error'>" . $_SESSION['user_deleted'] . "</div>";
        unset($_SESSION['user_deleted']);
    }

?>