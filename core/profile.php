<?php
    session_start();

    require_once(__DIR__ . '/../config.php');

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
        <link rel="stylesheet" href="../assets/css/profile.css">
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
        <div id="profile-page-container">
            <div class="avatar-container">
                <div class="avatar-wrapper">
                    <?php if(empty($_SESSION['user_avatar'])): ?>
                        <img src="../assets/images/no-avatar.jpeg" alt="No Avatar" width="250px" height="250px" />
                    <?php else: ?>
                        <?php if(file_exists(UPLOADS . $_SESSION['user_avatar'])): ?>
                            <img src="../uploads/<?php echo $_SESSION['user_avatar']; ?>" alt="User avatar" width="250px" height="250px" />
                        <?php else: ?>
                            <img src="../assets/images/no-avatar.jpeg" alt="No Avatar" width="250px" height="250px" />
                        <?php endif; ?>        
                    <?php endif; ?>    
                </div>
                <div class="avatar-form">
                    <form action="user-avatar.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <input type="file" name="avatar" accept="image/*" />
                        </div>
                        <div class="upload-btn-box">
                            <input type="submit" value="Upload" name="upload" id="upload-btn">
                        </div>

                        <?php if(isset($_SESSION['upload_error'])): ?>
                            <div class="error-msg-box">
                                <p>
                                    <?php
                                        echo "<div id='profile-flash-msg-el' class='profile-flash-msg-box'>" . $_SESSION['upload_error'] . "</div>";
                                        unset($_SESSION['upload_error']);
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($_SESSION['upload_success'])): ?>
                            <div class="success-msg-box">
                                <p>
                                    <?php
                                        echo "<div id='profile-flash-msg-el' class='profile-flash-msg-box'>" . $_SESSION['upload_success'] . "</div>";
                                        unset($_SESSION['upload_success']);
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
            <div class="main-user-data-container">

                <?php if(isset($_SESSION['user_name'])): ?>
                    <div class="user-name-style main-user-data-box-style">
                        <p><b>Name: </b><?php echo $_SESSION['user_name']; ?></p>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_email'])): ?>
                    <div class="user-email-style main-user-data-box-style">
                        <p><b>Email: </b><?php echo $_SESSION['user_email']; ?></p>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_role'])): ?>
                    <div class="user-role-style main-user-data-box-style">
                        <p><b>Role: </b><?php echo $_SESSION['user_role']; ?></p>
                    </div>
                <?php endif; ?>

                <div class="edit-profile-data-btn-container">
                    <a href="user-edit.php" class="edit-profile-data-btn">Edit</a>
                </div>

            </div>
        </div>
        <script src="../assets/js/flash-msg.js"></script>
        <script src="../assets/js/profile-flash-msg.js"></script>
        <script src="../assets/js/navigation.js"></script>
    </body>
</html>