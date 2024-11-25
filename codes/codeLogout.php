<?php
// Iniciar sesion
session_start();

// Destruir todas las variables de sesion
session_unset();

// Destruir la sesion
session_destroy();

// Redirigir al login o pagina principal
header("Location: ../login.php");
exit();
