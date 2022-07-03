<?php
    session_start();

    // check if user is logged in
    if(!isset($_SESSION['user_id'])){
        header('Location: ../login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/navigation.css">
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="shortcut icon" href="/favicon.ico">
    </head>
    <body>
        <?php require('../navigation.php'); ?>
        <?php
        
            // check if successfull login message exists
            if(isset($_SESSION['login_message'])){
                echo "<div id='flash-msg-el' class='flash-msg-box flash-success'>" . $_SESSION['login_message'] . "</div>";
                unset($_SESSION['login_message']);
            }

            // check if successfull registration message exists
            if(isset($_SESSION['register_message'])){
                echo "<div id='flash-msg-el' class='flash-msg-box flash-success'>" . $_SESSION['register_message'] . "</div>";
                unset($_SESSION['register_message']);
            }

        ?>
        <h1>Profile page</h1>
        <script src="../assets/js/flash-msg.js"></script>
        <script src="../assets/js/navigation.js"></script>
    </body>
</html>