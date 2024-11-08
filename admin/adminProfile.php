<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es un administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['clasificacion'] !== 'Administrador') {
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
    <link rel="stylesheet" href="./styles/adminProfileStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="admin-profile-container">
        <?php include './components/header.php'; ?>

        <div class="admin-profile-content">
            <h2>Perfil del Administrador</h2>
            <div class="profile-info">
                <img src="<?php echo htmlspecialchars($_SESSION['foto_perfil']); ?>" alt="Foto de Perfil" class="profile-picture">
                <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></p>
                <p><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['correo']); ?></p>
                <p><strong>Clasificación:</strong> <?php echo htmlspecialchars($_SESSION['clasificacion']); ?></p>
                <p><strong>Fecha de Ingreso:</strong> <?php echo htmlspecialchars($_SESSION['fecha_ingreso']); ?></p>
            </div>
            <form action="./codes/codeAdminProfile.php" method="POST">
                <input type="submit" name="logout" value="Cerrar Sesión" class="logout-button">
            </form>
        </div>
    </div>

</body>

</html>