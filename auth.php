<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirigir al login
    header("Location: login.php");
    exit();
}

// Verificar si el usuario tiene el rol de cliente
if ($_SESSION['clasificacion'] !== 'Cliente') {
    // Si el usuario no es un cliente, redirigir a una página de error o al inicio
    header("Location: error_no_autorizado.php");
    exit();
}
