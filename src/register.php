<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/styles.css">
    <title>Register</title>
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
    $email = $_POST['email-input'];
    $password = $_POST['password-input'];
    $confirmPassword = $_POST['confirm-password-input'];

    // Verificar si las contraseñas coinciden
    if ($password === $confirmPassword) {
        if (register($username, $email, $password)) {
            // Redirigir a la página de login
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Las contraseñas no coinciden. Inténtalo de nuevo."; // Establecer mensaje de error
    }
}
?>
<div class="login-container">
    <form action="register.php" method="POST" class="login-form">
        <h2>Sign up</h2>

        <!-- Mostrar mensaje de error si está presente en la sesión -->
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error-message"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']); // Eliminar el mensaje después de mostrarlo ?>
        <?php endif; ?>

        <label for="username-input" class="form-label">Username</label>
        <input type="text" name="username-input" class="form-input" placeholder="Enter your username" required>

        <label for="email-input" class="form-label">Email</label>
        <input type="email" name="email-input" class="form-input" placeholder="Enter your email" required>

        <label for="password-input" class="form-label">Password</label>
        <input type="password" name="password-input" class="form-input" placeholder="Enter your password" required>

        <label for="confirm-password-input" class="form-label">Confirm Password</label>
        <input type="password" name="confirm-password-input" class="form-input" placeholder="Confirm your password" required>

        <input type="submit" value="Register" class="form-submit">
        <input type="reset" value="Clear" class="form-reset">
    </form>
</div>

</body>
</html>

