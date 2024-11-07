<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="login">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>

            <?php
            if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso') {
                echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.');</script>";
            }
            if (isset($_GET['error']) && $_GET['error'] === 'credenciales') {
                echo "<script>alert('Usuario o contraseña incorrectos. Inténtalo de nuevo.');</script>";
            }
            ?>

            <form action="./codes/codeLogin.php" method="POST">
                <div class="form-group">
                    <label for="login_username">Usuario</label>
                    <input type="text" id="login_username" name="nombre_usuario" required>
                </div>
                <div class="form-group">
                    <label for="login_password">Contraseña</label>
                    <input type="password" id="login_password" name="contraseña" required>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>