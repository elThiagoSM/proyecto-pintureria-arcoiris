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
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
    <div class="login">
        <div class="login-container">
            <h2>Restablecer Contraseña</h2>
            <form action="./codes/codeResetPassword.php" method="POST">
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                <input type="hidden" name="correo" value="<?php echo $_GET['correo']; ?>">
                <div class="form-group">
                    <input placeholder="Nueva Contraseña" type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <input placeholder="Confirmar Nueva Contraseña" type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn">Restablecer Contraseña</button>
            </form>
        </div>
    </div>

    <script>
        // Validar que ambas contraseñas coincidan
        document.querySelector("form").onsubmit = function() {
            const newPassword = document.getElementById("new_password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            if (newPassword !== confirmPassword) {
                alert("Las contraseñas no coinciden.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>