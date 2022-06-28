<?php require('core/login-logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/register.css">
        <link rel="shortcut icon" href="/favicon.ico">
    </head>
    <body>
        <?php require('navigation.php'); ?>
        <div id="form-container">
            <div>
                <form action="login.php" method="POST">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <h3 class="box-style">Login form</h3>
                    <div class="box-style">
                        <div>
                            <input type="text" name="email" placeholder="Email..." class="field-style" autocomplete="off" maxlength="255" 
                                value="<?php echo (isset($_SESSION['temp_email'])) ? $_SESSION['temp_email'] : ''; ?>">
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
                        <div>
                            <input type="password" name="password" placeholder="Password..." class="field-style">
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
                        <div>
                            <input type="submit" value="Login" name="login" id="log-btn" title="Login">
                        </div>
                        <div class="error-msg-box">
                            <p>
                                <?php
                                    if(isset($_SESSION['token_error'])){
                                        echo $_SESSION['token_error'];
                                        unset($_SESSION['token_error']);
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- <script src="assets/js/flash-msg.js"></script> -->
    </body>
</html>