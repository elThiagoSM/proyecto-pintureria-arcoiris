<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Inicio de Sesión</title>
    <link rel="stylesheet" href="./styles/loginAdminStyles.css">
</head>

<body>
    <div class="login-container">
        <h1>Panel de Administración</h1>
        <form action="./codes/codeLoginAdmin.php" method="POST">
            <div class="form-group">
                <input placeholder="Nombre de usuario" type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>

            <div class="form-group">
                <input placeholder="Contraseña" type="password" id="contraseña" name="contraseña" required>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        const params = new URLSearchParams(window.location.search);
        if (params.has('error')) {
            let message = '';
            switch (params.get('error')) {
                case 'contraseña_incorrecta':
                    message = 'Contraseña incorrecta.';
                    break;
                case 'sin_permiso':
                    message = 'No tienes permisos de administrador o el usuario no existe.';
                    break;
                default:
                    message = 'Error desconocido.';
            }
            alert(message);
        }
    </script>
</body>

</html>