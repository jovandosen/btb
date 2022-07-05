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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit profile data</title>
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/navigation.css">
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="stylesheet" href="../assets/css/profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="/favicon.ico">
    </head>
    <body>
        <?php require('../navigation.php'); ?>
        <div id="form-container">
            <div>
                <form action="user-edit-logic.php" method="POST">
                    <h3 class="box-style">Edit profile data form</h3>
                    <div class="box-style">
                        <div class="auth-form-field">
                            <i class="fa fa-user"></i>
                            <input type="text" name="name" placeholder="Name..." 
                                class="field-style <?php echo (isset($_SESSION['name_error'])) ? 'form-field-error' : ''; ?>" autocomplete="off" maxlength="255" 
                                value="<?php echo (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : ''; ?>">
                        </div>
                        <div class="error-msg-box">
                            <p>
                                <?php
                                    if(isset($_SESSION['name_error'])){
                                        echo $_SESSION['name_error'];
                                        unset($_SESSION['name_error']);
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="box-style">
                        <div class="auth-form-field">
                            <i class="fa fa-envelope"></i>
                            <input type="text" name="email" placeholder="Email..." 
                                class="field-style <?php echo (isset($_SESSION['email_error'])) ? 'form-field-error' : ''; ?>" autocomplete="off" maxlength="255" 
                                value="<?php echo (isset($_SESSION['user_email'])) ? $_SESSION['user_email'] : ''; ?>">
                        </div>
                        <div class="error-msg-box">
                            <p>
                                <?php
                                    if(isset($_SESSION['email_error'])){
                                        echo $_SESSION['email_error'];
                                        unset($_SESSION['email_error']);
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="box-style">
                        <select name="role" id="user-role">
                            <option value="user"
                                <?php echo (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') ? 'selected' : ''; ?>
                            >User</option>
                            <option value="admin"
                                <?php echo (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') ? 'selected' : ''; ?>
                            >Admin</option>
                        </select>
                    </div>
                    <div class="box-style">
                        <div>
                            <input type="submit" value="Update" name="update" id="update-btn" title="Update data" class="edit-profile-data-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="../assets/js/navigation.js"></script>
    </body>
</html>