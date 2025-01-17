<header>
    <div class="logo">
        <img src="../assets/img/logo.png" alt="PokéAPI Logo">
        <h1>PokéAPI</h1>
    </div>
    <nav>
        <?php
            session_start(); // Iniciar la sesión para verificar el estado del usuario
            if (isset($_SESSION['username'])) {
                // Si el usuario está logeado, mostramos el enlace de "Logout"
                echo '<a href="logout.php">Logout</a>';
            } else {
                // Si el usuario no está logeado, mostramos los enlaces de "Login" y "Registro"
                echo '<a href="login.php">Login</a>';
                echo '<a href="register.php">Sign up</a>';
            }
        ?>
    </nav>
</header>
