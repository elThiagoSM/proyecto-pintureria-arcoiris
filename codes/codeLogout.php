<?php
// Iniciar sesion
session_start();

// Borrar todas las cookies configuradas
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode('; ', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600, '/');
        setcookie($name, '', time() - 3600); // Para compatibilidad en algunas configuraciones
    }
}

// Destruir la sesion actual
session_unset();
session_destroy();

// Redirigir al usuario a la pgina de inicio de sesion
header("Location: ../login.php");
exit();
