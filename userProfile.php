<?php
// Verificar si las cookies están configuradas, lo que indica que el usuario está logueado
if (isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['correo']) && isset($_COOKIE['clasificacion'])) {
  // Obtener los valores desde las cookies
  $nombre_usuario = $_COOKIE['nombre_usuario'];
  $correo = $_COOKIE['correo'];
  $clasificacion = $_COOKIE['clasificacion'];
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

  <div class="profile">
    <div class="profile-container">
      <div class="profile-picture-section">
        <img class="user-profile-picture" src="https://via.placeholder.com/200" alt="Avatar" />

        <div class="action-buttons">
          <button class="btn">Seleccionar</button>
        </div>
      </div>

      <div class="profile-details-section">
        <h2><?php echo $nombre_usuario; ?> <span class="user-role" style="font-size: 0.8em">(<?php echo $clasificacion; ?>)</span></h2>

        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" value="<?php echo $nombre_usuario; ?>" readonly />

        <label for="email">Correo:</label>
        <input type="email" id="email" value="<?php echo $correo; ?>" readonly />

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