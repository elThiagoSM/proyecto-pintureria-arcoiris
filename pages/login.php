<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="contenedor">
       <!-- Formulario de Inicio de Sesión -->
       <div class="contenedorLogin">
           <h2>Iniciar Sesión</h2>
           <form action="codeLogin.php" method="POST">
              <div class="botone">
                <label for="login_username">Usuario</label>
                <input type="text" id="login_username" name="username" required>
              </div>
              <div class="botone">
                <label for="login_password">Contraseña</label>
                <input type="password" id="login_password" name="password" required>
              </div>
           </form>
           <p><a href="">Olvidaste tu contraseña?</a></p>
           <p>¿No estás registrado? <a href="Register.html">Hazlo aquí</a></p>
           <p>tome?<a href="index.php">tome tome tome</a></p>
           <button type="submit">Ingresar</button>
       </div>
   </div>
</body>

</html>