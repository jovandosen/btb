<?php

// create db connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// check if there are any db connection errors
if($conn->connect_errno){
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}