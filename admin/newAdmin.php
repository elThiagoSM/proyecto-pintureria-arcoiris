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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Administrador</title>
    <link rel="stylesheet" href="./styles/newAdminStyles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Administrador</h1>
        <!-- Formulario para agregar un nuevo administrador -->
        <form action="./codes/codeNewAdmin.php" method="POST">
            <!-- Nombre de usuario -->
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>

            <!-- Correo -->
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="confirmar_contraseña">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
            </div>

            <!-- Clasificación (Oculto, siempre "Administrador") -->
            <input type="hidden" name="clasificacion" value="Administrador">

            <!-- Botón de enviar -->
            <div class="form-group">
                <button type="submit">Agregar Administrador</button>
            </div>
        </form>
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