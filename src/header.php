
<header>
    <div class="logo">
        <img src="../assets/img/logo.png" alt="PokéAPI Logo">
        <h1>PokéAPI</h1>
    </div>
    <nav>
        <?php
        if (isset($_cookie['username'])) {
            echo '<a href="logout.php">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Sign up</a>';
        }
        ?>
    </nav>
</header>
