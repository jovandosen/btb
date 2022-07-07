<?php

    // start the session
    session_start();

    require_once(__DIR__ . '/../config.php');

    require(ABSPATH . 'db.php');

    if(!isset($_SESSION['user_id'])){
        header('Location: ../login.php');
        exit();
    }

    if(isset($_GET['selected-page'])){
        $currentPage = $_GET['selected-page'];
    } else {
        $currentPage = 1;
    }

    $perPage = 10;

    $offset = ($perPage * $currentPage) - $perPage;

    $allRecords = "SELECT * FROM users";
    
    $allRecordsResult = $conn->query($allRecords);

    $totalRecords = $allRecordsResult->num_rows;

    $totalPages = ceil($totalRecords / $perPage);

    $sql = "SELECT * FROM users LIMIT 10 OFFSET $offset";

    $result = $conn->query($sql);

    $conn->close();

    if(isset($_SESSION['user_deleted'])){
        echo "<div id='flash-msg-el' class='flash-msg-box flash-error'>" . $_SESSION['user_deleted'] . "</div>";
        unset($_SESSION['user_deleted']);
    }

?>