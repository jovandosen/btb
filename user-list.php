<?php

    // start the session
    session_start();

    // create db connection
    $conn = new mysqli("localhost", "jovan", "protector-994", "btb");

    // check if there are any db connection errors
    if($conn->connect_errno){
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

    $sql = "SELECT * FROM users";

    $result = $conn->query($sql);

    if(isset($_SESSION['user_deleted'])){

        echo "<div id='flash-msg-el' class='flash-msg-box flash-error'>" . $_SESSION['user_deleted'] . "</div>";

        // remove all session variables and destroy session
        session_unset();
        session_destroy();
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User list</title>
    </head>
    <body>
        <?php require('navigation.php'); ?>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            #user-table-container {
                width: 500px;
                height: auto;
                margin: 100px auto;
            }
            .link-style {
                text-decoration: none;
            }
            .link-style:hover {
                text-decoration: underline;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
            }
            #user-table {
                margin: 10px auto;
            }
            #delete-user-btn {
                padding: 5px;
                border: none;
                background-color: red;
                color: white;
            }
            #edit-user-btn {
                padding: 5px;
                border: none;
                background-color: lightblue;
            }
            #delete-user-btn:hover, #edit-user-btn:hover {
                cursor: pointer;
            }
            .flash-msg-box {
                padding: 20px;
                font-size: 18px;
                color: white;
            }
            .flash-error {
                background-color: red;
            }
        </style>
        <div id="user-table-container">
            <?php if($result->num_rows > 0): ?>
                <h3>User list</h3>
                <table style="width:100%" id="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PASSWORD</th>
                            <th>OPTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_object()): ?>
                            <tr>
                                <td>
                                    <?php echo $row->id; ?>
                                </td>
                                <td>
                                    <?php echo $row->name; ?>
                                </td>
                                <td>
                                    <?php echo $row->email; ?>
                                </td>
                                <td>
                                    <?php echo $row->password; ?>
                                </td>
                                <td>
                                    <form action="delete-user.php" method="POST">
                                        <input type="hidden" name="userID" value="<?php echo $row->id; ?>">
                                        <input type="submit" value="delete" name="delete" id="delete-user-btn" title="Delete this record">
                                        <input type="submit" value="edit" name="edit" id="edit-user-btn" title="Edit user">
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>    
                    </tbody>
                </table>
            <?php else: ?>
                <h3>No records found.</h3>    
            <?php endif; ?>
            <a href="register.php" class="link-style">Register page</a>
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