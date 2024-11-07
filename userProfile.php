<?php
// Verificar si las cookies estan configuradas, lo que indica que el usuario esta logueado
if (isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['correo']) && isset($_COOKIE['clasificacion'])) {
  // Obtener los valores desde las cookies
  $nombre_usuario = $_COOKIE['nombre_usuario'];
  $correo = $_COOKIE['correo'];
  $clasificacion = $_COOKIE['clasificacion'];
  $direccion = isset($_COOKIE['direccion']) ? $_COOKIE['direccion'] : '';
  $datos_contacto = isset($_COOKIE['datos_contacto']) ? $_COOKIE['datos_contacto'] : '';
  $fecha_nacimiento = isset($_COOKIE['fecha_nacimiento']) ? $_COOKIE['fecha_nacimiento'] : '';
  $cedula = isset($_COOKIE['cedula']) ? $_COOKIE['cedula'] : '';
} else {
  // Si no hay cookies, redirigir al login
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de Usuario</title>
  <link rel="stylesheet" href="css/userProfileStyles.css" />
</head>

<body>
  <?php include 'components/header.php'; ?>

  <!-- Mostrar alerta de axito si esta presente en la URL -->
  <?php if (isset($_GET['success'])): ?>
    <script>
      alert("<?php echo htmlspecialchars($_GET['success']); ?>");
    </script>
  <?php endif; ?>

  <div class="profile">
    <div class="profile-container">
      <div class="profile-picture-section">
        <img class="user-profile-picture" src="https://via.placeholder.com/200" alt="Avatar" />

        <div class="action-buttons">
          <button class="btn">Seleccionar</button>
        </div>
      </div>

      <div class="profile-details-section">
        <h2><?php echo htmlspecialchars($nombre_usuario); ?> <span class="user-role" style="font-size: 0.8em">(<?php echo htmlspecialchars($clasificacion); ?>)</span></h2>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" value="<?php echo htmlspecialchars($nombre_usuario); ?>" readonly />

        <label for="email">Correo:</label>
        <input type="email" id="email" value="<?php echo htmlspecialchars($correo); ?>" readonly />

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" value="<?php echo htmlspecialchars($direccion); ?>" readonly />

        <label for="contacto">Datos de Contacto:</label>
        <input type="text" id="contacto" value="<?php echo htmlspecialchars($datos_contacto); ?>" readonly />

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" value="<?php echo htmlspecialchars($fecha_nacimiento); ?>" readonly />

        <label for="cedula">Cédula:</label>
        <input type="text" id="cedula" value="<?php echo htmlspecialchars($cedula); ?>" readonly />

        <div class="action-buttons">
          <button class="btn">Guardar</button>
          <button class="btn">Cambiar contraseña</button>
          <form action="./codes/codeLogout.php" method="post">
            <button class="btn" type="submit">Salir</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include 'components/footer.php'; ?>
</body>

</html>