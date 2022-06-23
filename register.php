<?php

    // start the session
    session_start();

    // check if successfull registration message exists
    if(isset($_SESSION['register_message'])){

        echo "<div id='flash-msg-el' class='flash-msg-box flash-success'>" . $_SESSION['register_message'] . "</div>";

        // remove all session variables and destroy session
        session_unset();
        session_destroy();
    }

    // check if register button is clicked
    if(isset($_POST['register'])){

        // collect form data using POST request method, also trim data
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // format user input
        $name = ucfirst(strtolower($name));
        $email = strtolower($email);

        // save temporary form data so user doesn't have to type over and over
        $_SESSION['temp_name'] = $name;
        $_SESSION['temp_email'] = $email;

        // set default error value
        $error = false;

        // form validation
        if(empty($name)){
            $error = true;
            $_SESSION['name_error'] = 'Name can not be empty.';
        } else {
            if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
                $error = true;
                $_SESSION['name_error'] = 'Name can contain only letters and white spaces.';
            }
        }

        if(empty($email)){
            $error = true;
            $_SESSION['email_error'] = 'Email can not be empty.';
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = true;
                $_SESSION['email_error'] = 'Email is not valid.';
            }
        }

        if(empty($password)){
            $error = true;
            $_SESSION['password_error'] = 'Password can not be empty.';
        }

        // if there are no validation errors
        if($error === false){

            // create db connection
            $conn = new mysqli("localhost", "jovan", "protector-994", "btb");

            // check if there are any db connection errors
            if($conn->connect_errno){
                echo "Failed to connect to MySQL: " . $conn->connect_error;
                exit();
            }

            // prepare sql query
            $sqlPrepare = $conn->prepare("INSERT INTO users(name, email, password) VALUES(?, ?, ?)");

            // bind user input fields
            $sqlPrepare->bind_param("sss", $name, $email, $password);

            // run query
            $sqlPrepare->execute();

            // close prepared statement
            $sqlPrepare->close();

            // close connection
            $conn->close();

            // set successfull registration message
            $_SESSION['register_message'] = 'New record successfully added to database.';

            // redirect back to same page, to reset HTTP state
            header('Location: register.php');

            // kill the script
            exit();

        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <?php require('navigation.php'); ?>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            #form-container {
                width: 500px;
                height: auto;
                margin: 100px auto;
            }
            .field-style {
                padding: 10px;
                width: 300px;
            }
            #reg-btn {
                padding: 10px;
                color: white;
                background-color: lightseagreen;
                border: none;
            }
            #reg-btn:hover {
                cursor: pointer;
            }
            .box-style {
                margin-bottom: 10px;
            }
            .error-msg-box {
                margin-top: 5px;
                color: red;
                font-size: 15px;
            }
            .link-style {
                text-decoration: none;
            }
            .link-style:hover {
                text-decoration: underline;
            }
            .flash-msg-box {
                padding: 20px;
                font-size: 18px;
            }
            .flash-success {
                background-color: lightgreen;
            }
        </style>
        <div id="form-container">
            <form action="register.php" method="POST">
                <h3 class="box-style">Register form</h3>
                <div class="box-style">
                    <div>
                        <input type="text" name="name" placeholder="Name..." class="field-style" autocomplete="off" maxlength="255" 
                            value="<?php echo (isset($_SESSION['temp_name'])) ? $_SESSION['temp_name'] : ''; ?>">
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
                    <input type="submit" value="Register" name="register" id="reg-btn" title="Register">
                </div>
            </form>
            <a href="user-list.php" class="link-style">User list</a>
        </div>
        <script>
            let flashMsgNum = document.getElementsByClassName("flash-msg-box").length;

            if(flashMsgNum > 0){
                setTimeout(function(){
                    let flashMsgEl = document.getElementById("flash-msg-el");
                    flashMsgEl.remove();
                }, 3000);
            }
        </script>
    </body>
</html>