<?php require('core/login-logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/navigation.css">
        <link rel="stylesheet" href="assets/css/register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <div class="auth-form-field">
                            <i class="fa fa-envelope"></i>
                            <input type="text" name="email" placeholder="Email..." 
                                class="field-style <?php echo (isset($_SESSION['email_error'])) ? 'form-field-error' : ''; ?>" autocomplete="off" maxlength="255" 
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
                        <div class="password-field-container">
                            <i class="fa fa-key"></i>
                            <input type="password" name="password" placeholder="Password..." 
                                class="field-style password-input-el <?php echo (isset($_SESSION['password_error'])) ? 'form-field-error' : ''; ?>" id="password">
                            <div class="password-eye-box">
                                <div class="password-eye-with-slash btb-eye eye-slash-el" id="eye-slash-element">
                                    <img src="assets/images/eye-slash.svg" alt="Eye slash" title="Click to show password">
                                </div>
                                <div class="password-eye-no-slash btb-eye" id="eye-element" style="display: none;">
                                    <img src="assets/images/eye.svg" alt="Eye" title="Click to hide password">
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
        <script src="assets/js/password-visibility.js"></script>
    </body>
</html>