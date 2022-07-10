<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require_once(ABSPATH . 'vendor/autoload.php');

use App\Models\User;

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

$user = new User();

$allRecordsResult = $user->all();

$totalRecords = $allRecordsResult->num_rows;

$totalPages = ceil($totalRecords / $perPage);

$user = new User();

$result = $user->paginate($perPage, $currentPage);

if(isset($_SESSION['user_deleted'])){
    echo "<div id='flash-msg-el' class='flash-msg-box flash-error'>" . $_SESSION['user_deleted'] . "</div>";
    unset($_SESSION['user_deleted']);
}

?>