<?php
if (isset($_GET['error']) && $_GET['error'] === 'correo_no_verificado') {
    echo "<script>alert('Tu correo no está verificado. Por favor, revisa tu correo para confirmarlo.');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
    <div class="login">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>

            <?php
            if (isset($_GET['registro']) && $_GET['registro'] === 'exitoso') {
                echo "<script>alert('Registro exitoso. Revisa tu correo para verificar tu cuenta antes de iniciar sesión.');</script>";
            }
            if (isset($_GET['error'])) {
                if ($_GET['error'] === 'credenciales') {
                    echo "<script>alert('Usuario o contraseña incorrectos. Inténtalo de nuevo.');</script>";
                } elseif ($_GET['error'] === 'verificacion') {
                    echo "<script>alert('Tu correo no está verificado. Por favor revisa tu correo y verifica tu cuenta.');</script>";
                }
            }
            ?>

            <form action="./codes/codeLogin.php" method="POST">
                <div class="form-group">
                    <input placeholder="Usuario" type="text" id="login_username" name="nombre_usuario" required>
                </div>
                <div class="form-group">
                    <input placeholder="Contraseña" type="password" id="login_password" name="contraseña" required>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
            <a href="index.php">Volver a la pagina principal</a>
        </div>
    </div>
</body>

</html>