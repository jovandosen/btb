<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="shortcut icon" href="/favicon.ico">
    </head>
    <body>
        <?php require('../navigation.php'); ?>
        <?php
        
            // check if successfull registration message exists
            if(isset($_SESSION['login_message'])){
                echo "<div id='flash-msg-el' class='flash-msg-box flash-success'>" . $_SESSION['login_message'] . "</div>";
                unset($_SESSION['login_message']);
            }

        ?>
        <h1>Profile page</h1>
        <script src="../assets/js/flash-msg.js"></script>
    </body>
</html>