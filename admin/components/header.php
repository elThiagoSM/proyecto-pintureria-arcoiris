<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="./styles/headerStyles.css">
</head>

<body>
    <div class="header">

        <a class="linkeable" href="adminProfile.php">
            <img src="<?php echo isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'https://via.placeholder.com/30'; ?>" alt="Imagen de usuario">
            <span class="username"><?php echo isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario Invitado'; ?></span>
        </a>
    </div>
</body>

</html>