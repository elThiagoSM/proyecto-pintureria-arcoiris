<?php
// Verificar si las cookies están configuradas y si el usuario es un administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    // Si no es administrador o no está autenticado, redirigir al inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./styles/dashboardStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="dashboard-container">
        <?php include './components/header.php'; ?>

        <div class="dashboard-content">

        </div>
    </div>

</body>

</html>