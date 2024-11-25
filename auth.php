<?php
session_start();

// Verificar si el usuario ha iniciado sesin
if (!isset($_SESSION['id_usuario'])) {
    // Redirigir a la pagina de inicio de sesion si no ha iniciado sesion
    header("Location: http://localhost/proyecto-pintureria-arcoiris/login.php?error=acceso_restringido");
    exit();
}

// Verificacin adicional para usuarios administrador
// por clasificacion o tipo de usuario
// if ($_SESSION['clasificacion'] !== 'admin') {
//     header("Location: ../login.php?error=acceso_restringido");
//     exit();
// }
