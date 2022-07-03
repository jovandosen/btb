<?php

session_start();

require_once(__DIR__ . '/../config.php');

require(ABSPATH . 'db.php');

$admins = [];

/* Admin - Damjan */
$adminOne = new stdClass();

$adminOne->name = "Damjan";
$adminOne->email = "damjan@gmail.com";
$adminOne->password = password_hash("protector982!", PASSWORD_DEFAULT);
$adminOne->role = "admin";
$adminOne->last_login = date('Y-m-d H:i:s');
$adminOne->created = date('Y-m-d H:i:s');
$adminOne->updated = date('Y-m-d H:i:s');

/* Admin - Jovan */
$adminTwo = new stdClass();

$adminTwo->name = "Jovan";
$adminTwo->email = "jovan@gmail.com";
$adminTwo->password = password_hash("protector994!", PASSWORD_DEFAULT);
$adminTwo->role = "admin";
$adminTwo->last_login = date('Y-m-d H:i:s');
$adminTwo->created = date('Y-m-d H:i:s');
$adminTwo->updated = date('Y-m-d H:i:s');

/* Admin - Jaroslav */
$adminThree = new stdClass();

$adminThree->name = "Jaroslav";
$adminThree->email = "jaroslav@gmail.com";
$adminThree->password = password_hash("protector987!", PASSWORD_DEFAULT);
$adminThree->role = "admin";
$adminThree->last_login = date('Y-m-d H:i:s');
$adminThree->created = date('Y-m-d H:i:s');
$adminThree->updated = date('Y-m-d H:i:s');

/* All admins */
$admins[] = $adminOne;
$admins[] = $adminTwo;
$admins[] = $adminThree;

/* Store admins in db */
for($i = 0; $i < count($admins); $i++){

    $sql = "INSERT INTO users(name, email, password, role, last_login, created, updated) 
            VALUES(
                '".$admins[$i]->name."', 
                '".$admins[$i]->email."', 
                '".$admins[$i]->password."', 
                '".$admins[$i]->role."', 
                '".$admins[$i]->last_login."', 
                '".$admins[$i]->created."', 
                '".$admins[$i]->updated."'
            )";

    $conn->query($sql);

}

$conn->close();