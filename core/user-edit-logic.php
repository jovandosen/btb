<?php

// start the session
session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

if(isset($_POST['update'])){

    echo 'update user profile data';

}