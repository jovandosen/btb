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
</style>
<nav>
    <ul>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php else: ?>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>    
        <?php endif; ?>
    </ul>
</nav>