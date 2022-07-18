<nav id="btb-nav">
    <ul>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php else: ?>
            <li class="user-links-wrapper" id="user-links-wrapper-box">
                <a href="javascript:void(0)"><?php echo (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : 'No Name'; ?></a>
                <ul class="logged-user-dropdown-links" id="logged-user-dropdown-links-el">
                    <li><a href="../core/profile.php">Profile</a></li>

                    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"): ?>
                        <li><a href="../core/user-list.php">User List</a></li>
                        <li><a href="../helper/generate-users.php">Generate Users</a></li>
                        <li><a href="../helper/users-pdf.php">Make Users Pdf</a></li>
                    <?php endif; ?>

                    <li><a href="../core/user-settings.php">Settings</a></li>
                    
                    <li><a href="../core/logout.php">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</nav>