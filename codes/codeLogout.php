<?php
// Destruir las cookies
setcookie("nombre_usuario", "", time() - 3600, "/");
setcookie("correo", "", time() - 3600, "/");
setcookie("clasificacion", "", time() - 3600, "/");

// Redirigir al login
header("Location: ../login.php");
exit();
