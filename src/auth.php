<?php
require_once 'jsonhandler.php';

function login($username, $password):bool{
    $filePath = '../assets/databases/users.json';
    $users = loadUsersFromJson($filePath);
    foreach ($users as $user) {
        // Comprobar si el usuario existe y verificar la contraseña encriptada
        if ($username == $user['username'] && password_verify($password, $user['password'])) {
            // Establecer la sesión si las credenciales son correctas
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $user['email']; // También guardamos el email si lo necesitas
            return true;
        }

    }
    return false;
}

function register($username, $email, $password ):bool{

    $filePath = '../assets/databases/users.json';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Crear el usuario
    $user = [
        'username' => $username,
        'password' => $hashedPassword,
        'email' => $email
    ];

    // Guardar el usuario en el archivo JSON
    if(saveUserToJson($user, $filePath)){
        return true;
    }
    return false;
}