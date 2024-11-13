<?php
// auth.php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: ../login.php?error=acceso_restringido");
    exit();
}

// Verificacin adicional para usuarios administrador
// por clasificacion o tipo de usuario
// if ($_SESSION['clasificacion'] !== 'admin') {
//     header("Location: ../login.php?error=acceso_restringido");
//     exit();
// }
