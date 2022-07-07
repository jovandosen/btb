<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
    exit();
}

if(isset($_GET['term'])){

    $term = $_GET['term'];

    $sqlPrepareSelect = $conn->prepare("SELECT id, name, email, created, updated FROM users WHERE name LIKE ? OR email LIKE ? OR role LIKE ?");

    $prepareTerm = '%' . $term .  '%';
    
    $sqlPrepareSelect->bind_param("sss", $prepareTerm, $prepareTerm, $prepareTerm);

    $sqlPrepareSelect->execute();

    $sqlPrepareSelect->bind_result($i, $n, $e, $c, $u);

}