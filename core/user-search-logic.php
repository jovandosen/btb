<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
    exit();
}