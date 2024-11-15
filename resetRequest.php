<?php
session_start();

if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
    <div class="login">
        <div class="login-container">
            <h2>Recuperar Contraseña</h2>
            <form action="./codes/codeResetRequest.php" method="POST">
                <div class="form-group">
                    <input placeholder="Correo electrónico" type="email" id="correo" name="correo" required>
                </div>
                <button type="submit" class="btn">Enviar enlace de recuperación</button>
            </form>
            <p><a href="index.php">Volver a la página principal</a></p>
        </div>
    </div>
</body>

</html>