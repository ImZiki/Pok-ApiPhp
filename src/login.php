<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <title>Login</title>
</head>
<body>
<?php require_once 'header.php';?>
<?php
// Iniciar sesión si aún no se ha iniciado
require_once './utils/auth.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username-input'];
    $password = $_POST['password-input'];
    if (login($username, $password)) {
        header("location: api.php");
        exit();
    } else {
        $_SESSION['error'] = "Credenciales incorrectas. Inténtalo de nuevo."; // Establecer mensaje de error
    }
}
?>
<div class="login-container">
    <form action="login.php" method="POST" class="login-form">
        <h2>Login</h2>

        <!-- Mostrar mensaje de error si está presente en la sesión -->
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); // Eliminar el mensaje después de mostrarlo ?>
        <?php endif; ?>

        <label for="username-input" class="form-label">Username</label>
        <input type="text" name="username-input" class="form-input" placeholder="Enter your username" required>

        <label for="password-input" class="form-label">Password</label>
        <input type="password" name="password-input" class="form-input" placeholder="Enter your password" required>

        <input type="submit" value="Login" class="form-submit">
    </form>
</div>
</body>
</html>