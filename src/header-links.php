<?php
// Obtener la página desde el parámetro GET
$page = $_GET['page'] ?? '';

// Verificar la página actual y devolver los enlaces correspondientes
if ($page === "api.php") {
    echo '<a href="logout.php">Logout</a>';
} elseif ($page === "login.php" || $page === "register.php") {
    echo '<a href="login.php">Login</a>';
    echo '<a href="register.php">Sign up</a>';
} else {
    echo '<a href="login.php">Login</a>';
    echo '<a href="register.php">Sign up</a>';
}
