<?php

    // Redirigir al login
    setcookie("username", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
