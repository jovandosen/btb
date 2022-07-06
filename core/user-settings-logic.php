<?php

// start the session
session_start();

require_once('../config.php');

require(ABSPATH . 'db.php');

// check if user is logged in
if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
    exit();
}