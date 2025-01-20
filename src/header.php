<?php
$page = basename($_SERVER['PHP_SELF']);
?>

<header>
    <div class="logo">
        <img src="../assets/img/logo.png" alt="PokéAPI Logo">
        <h1>PokéAPI</h1>
    </div>
    <nav>
        <?php if ($page === 'api.php'): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Sign up</a>
        <?php endif; ?>
    </nav>
</header>
