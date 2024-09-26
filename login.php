<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <?php include 'components/header.html'; ?>

  <div class="login">
    <div class="login-container">
      <h2>Iniciar Sesión</h2>
      <form action="./codes/codeLogin.php" method="POST">
        <div class="form-group">
          <label for="login_username">Usuario</label>
          <input type="text" id="login_username" name="username" required>
        </div>
        <div class="form-group">
          <label for="login_password">Contraseña</label>
          <input type="password" id="login_password" name="password" required>
        </div>
        <button type="submit" class="btn">Ingresar</button>
      </form>
      <p>¿Olvidaste tu contraseña?<a href="#">Presiona aquí</a></p>
      <p>¿No estás registrado? <a href="register.php">Hazlo aquí</a></p>
    </div>
  </div>

  <?php include 'components/footer.html'; ?>
</body>

</html>