<?php require('user-settings-logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Settings</title>
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
                <form action="user-settings-logic.php" method="POST">
                    <h3 class="box-style">Change password form</h3>
                    <div class="box-style">
                        <div class="password-field-container">
                            <i class="fa fa-key"></i>
                            <input type="password" name="password" placeholder="Current password..." 
                                class="field-style password-input-el <?php echo (isset($_SESSION['password_error'])) ? 'form-field-error' : ''; ?>" id="password">
                            <div class="password-eye-box">
                                <div>
                                    <img src="../assets/images/eye-slash.svg" alt="Eye slash" title="Click to show password" class="btb-eye eye-slash-el">
                                </div>
                                <div style="display: none;">
                                    <img src="../assets/images/eye.svg" alt="Eye" title="Click to hide password" class="btb-eye eye-no-slash-el">
                                </div>
                            </div>
                        </div>
                        <div class="error-msg-box">
                            <p>
                                <?php
                                    if(isset($_SESSION['password_error'])){
                                        echo $_SESSION['password_error'];
                                        unset($_SESSION['password_error']);
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="box-style">
                        <div class="password-field-container">
                            <i class="fa fa-key"></i>
                            <input type="password" name="new-password" placeholder="New password..." 
                                class="field-style password-input-el <?php echo (isset($_SESSION['new_password_error'])) ? 'form-field-error' : ''; ?>" id="new-password">
                            <div class="password-eye-box">
                                <div>
                                    <img src="../assets/images/eye-slash.svg" alt="Eye slash" title="Click to show password" class="btb-eye eye-slash-el">
                                </div>
                                <div style="display: none;">
                                    <img src="../assets/images/eye.svg" alt="Eye" title="Click to hide password" class="btb-eye eye-no-slash-el">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-style">
                        <div class="password-field-container">
                            <i class="fa fa-key"></i>
                            <input type="password" name="repeat-new-password" placeholder="Repeat new password..." 
                                class="field-style password-input-el <?php echo (isset($_SESSION['repeat_password_error'])) ? 'form-field-error' : ''; ?>" id="repeat-new-password">
                            <div class="password-eye-box">
                                <div>
                                    <img src="../assets/images/eye-slash.svg" alt="Eye slash" title="Click to show password" class="btb-eye eye-slash-el">
                                </div>
                                <div style="display: none;">
                                    <img src="../assets/images/eye.svg" alt="Eye" title="Click to hide password" class="btb-eye eye-no-slash-el">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-style">
                        <div>
                            <input type="submit" value="Change" name="change-password" id="change-password-btn" title="Change password" class="edit-profile-data-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="../assets/js/flash-msg.js"></script>
        <script src="../assets/js/navigation.js"></script>
        <script src="../assets/js/password-visibility.js"></script>
    </body>
</html>