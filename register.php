<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
  <?php include 'components/header.php'; ?>

  <div class="register">
    <div class="register-container">
      <h2>Registrarse</h2>
      <form action="./codes/codeRegistro.php" method="POST">
        <div class="form-group">
          <label for="login_username">Usuario</label>
          <input type="text" id="login_username" name="nombre_usuario" required>
        </div>
        <div class="form-group">
          <label for="login_password">Contraseña</label>
          <input type="password" id="login_password" name="contraseña" required>
        </div>
        <div class="form-group">
          <label for="registra_correo">Correo electrónico</label>
          <input type="email" id="correo" name="correo" required>
        </div>
        <button type="submit" class="btn">Registrarse</button>
      </form>
      <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
  </div>

  <?php include 'components/footer.php'; ?>
</body>

</html>