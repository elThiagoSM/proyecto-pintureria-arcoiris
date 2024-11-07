<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar al panel de admin</title>
    <link rel="stylesheet" href="./styles/loginAdminStyles.css">
</head>

<body>
    <div class="login-container">
        <h2>Inicio de sesión - Administrador</h2>
        <form action="./codes/codeLoginAdmin.php" method="POST">
            <label for="nombre_usuario">Nombre de usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            <br><br>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
            <br><br>

            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</body>

</html>