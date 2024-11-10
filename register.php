<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
  <?php
  session_start();

  // Mostrar mensaje de error o éxito si existe
  if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Eliminar mensaje después de mostrarlo
  }
  if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']); // Eliminar mensaje después de mostrarlo
  }
  ?>

  <div class="login">
    <div class="login-container">

      <h2>Registrarse</h2>
      <form action="./codes/codeRegister.php" method="POST" onsubmit="return validarContraseñas();">
        <div class="form-group">
          <input placeholder="Nombre Completo" type="text" id="nombre_cliente" name="nombre_cliente" required>
        </div>
        <div class="form-group">
          <input placeholder="Usuario" type="text" id="login_username" name="nombre_usuario" required>
        </div>
        <div class="form-group">
          <input placeholder="Correo electrónico" type="email" id="correo" name="correo" required>
        </div>
        <div class="form-group">
          <input placeholder="Cédula" type="text" id="cedula" name="cedula" required>
        </div>
        <div class="form-group">
          <label for="fecha_nacimiento">Fecha de Nacimiento</label>
          <input placeholder="Fecha de Nacimiento" type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>
        <div class="form-group">
          <input placeholder="Dirección" type="text" id="direccion" name="direccion">
        </div>
        <div class="form-group">
          <input placeholder="Datos de Contacto" type="text" id="datos_contacto" name="datos_contacto">
        </div>
        <div class="form-group">
          <input placeholder="Contraseña" type="password" id="login_password" name="contraseña" required>
        </div>
        <div class="form-group">
          <input placeholder="Confirmar Contraseña" type="password" id="confirm_password" name="confirmar_contraseña" required>
        </div>
        <button type="submit" class="btn">Registrarse</button>
      </form>
      <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
      <a href="index.php">Volver a la pagina principal</a>

    </div>
  </div>

  <script>
    function validarContraseñas() {
      const password = document.getElementById("login_password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
        return false;
      }
      return true;
    }
  </script>
</body>

</html>