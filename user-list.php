<?php require('core/user-list-logic.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User list</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/user-list.css">
        <link rel="icon" href="favicon.png">
    </head>
    <body>
        <?php require('navigation.php'); ?>
        <div id="user-table-container">
            <?php if($result->num_rows > 0): ?>
                <h3>User list</h3>
                <table style="width:100%" id="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>CREATED</th>
                            <th>UPDATED</th>
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
                                    <?php echo $row->created; ?>
                                </td>
                                <td>
                                    <?php echo $row->updated; ?>
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
        <script src="assets/js/flash-msg.js"></script>
    </body>
</html>