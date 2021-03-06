<?php require('user-search-logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User search</title>
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/navigation.css">
        <link rel="stylesheet" href="../assets/css/user-list.css">
        <link rel="stylesheet" href="../assets/css/register.css">
        <link rel="stylesheet" href="../assets/css/pagination.css">
        <link rel="shortcut icon" href="/favicon.ico">
    </head>
    <body>
        <?php require('../navigation.php'); ?>
        <div id="user-table-container">
            <div class="form-search-container">
                <div><h3>Search results</h3></div>
                <div>
                    <a href="user-list.php" class="back-to-list-link">Back to user list</a>
                </div>
            </div>
            <div>
                <table style="width:100%" id="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>CREATED</th>
                            <th>UPDATED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td>
                                    <?php echo $user->id; ?>
                                </td>
                                <td>
                                    <?php echo $user->name; ?>
                                </td>
                                <td>
                                    <?php echo $user->email; ?>
                                </td>
                                <td>
                                    <?php echo $user->created; ?>
                                </td>
                                <td>
                                    <?php echo $user->updated; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </tbody>
                </table>
            </div>
        </div>
        <script src="../assets/js/flash-msg.js"></script>
        <script src="../assets/js/navigation.js"></script>
    </body>
</html>