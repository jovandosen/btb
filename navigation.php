<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    nav ul {
        list-style-type: none;
        background-color: #333;
        overflow: hidden;
        text-align: right;
    }
    nav ul li {
        display: inline-block;
        margin: 10px;
    }
    nav ul li a {
        text-decoration: none;
        color: white;
    }
    nav ul li a:hover {
        color: #cccccc;
    }
    .logged-user-dropdown-links {
        display: none;
        position: absolute;
        right: 0;
        top: 28px;   
    }
    .logged-user-dropdown-links li {
        display: block;
    }
</style>
<nav>
    <ul>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php else: ?>
            <li class="user-links-wrapper" id="user-links-wrapper-box">
                <a href="javascript:void(0)"><?php echo (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'No Name'; ?></a>
                <ul class="logged-user-dropdown-links" id="logged-user-dropdown-links-el">
                    <li><a href="profile.php">Profile</a></li>
                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"): ?>
                    <li><a href="user-list.php">User List</a></li>
                    <li><a href="../helper/generate-users.php">Generate Users</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</nav>