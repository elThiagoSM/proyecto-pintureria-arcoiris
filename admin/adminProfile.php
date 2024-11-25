<?php
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>
    <div class="admin-profile-container">
        <?php include './components/header.php'; ?>

        <div class="admin-profile-content">
            <h2>Perfil del Administrador</h2>
            <div class="profile-info">
                <div class="profile-pic-wrapper">
                    <?php if (!empty($_COOKIE['foto_perfil'])): ?>
                        <img src="<?php echo htmlspecialchars($_COOKIE['foto_perfil']); ?>" alt="<?php echo htmlspecialchars($_COOKIE['nombre_usuario']); ?>" class="profile-picture" id="profile-pic-preview">
                    <?php else: ?>
                        <p>No disponible</p>
                    <?php endif; ?>
                </div>
                <form action="./codes/codeAdminProfile.php" method="POST" enctype="multipart/form-data">
                    <input type="file" id="profile-image-input" name="profile_image" accept="image/*">
                    <button type="submit" name="update_image" class="update-button">Actualizar Imagen</button>
                </form>
                <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($_COOKIE['nombre_usuario']); ?></p>
                <p><strong>Correo:</strong> <?php echo htmlspecialchars($_COOKIE['correo']); ?></p>
                <p><strong>Clasificación:</strong> <?php echo htmlspecialchars($_COOKIE['clasificacion']); ?></p>
                <p><strong>Fecha de Ingreso:</strong> <?php echo htmlspecialchars($_COOKIE['fecha_ingreso']); ?></p>
            </div>
            <form action="./codes/codeAdminProfile.php" method="POST">
                <input type="submit" name="logout" value="Cerrar Sesión" class="logout-button">
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script src="./js/editProfilePicture.js"></script>
</body>

</html>