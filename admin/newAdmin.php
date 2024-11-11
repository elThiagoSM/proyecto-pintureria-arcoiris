<?php
// Redirige a la página de inicio de sesión si no hay cookies de sesión activas
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Administrador</title>
    <link rel="stylesheet" href="./styles/newAdminStyles.css">
</head>

<body>
    <div class="new-admin">
        <div class="new-admin-container">
            <h1>Agregar Nuevo Administrador</h1>
            <form action="./codes/codeNewAdmin.php" method="POST">
                <div class="form-group">
                    <input placeholder="Nombre de Usuario" type="text" id="nombre_usuario" name="nombre_usuario" required>
                </div>

                <div class="form-group">
                    <input placeholder="Correo" type="email" id="correo" name="correo" required>
                </div>

                <div class="form-group">
                    <input placeholder="Contraseña" type="password" id="contraseña" name="contraseña" required>
                </div>

                <div class="form-group">
                    <input placeholder="Confirmar Contraseña" type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
                </div>

                <input type="hidden" name="clasificacion" value="Administrador">

                <div class="form-group">
                    <button type="submit">Agregar Administrador</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Validación simple para verificar que las contraseñas coincidan
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('contraseña').value;
            const confirmPassword = document.getElementById('confirmar_contraseña').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert("Las contraseñas no coinciden. Por favor, verifica y vuelve a intentarlo.");
            }
        });
    </script>
</body>

</html>