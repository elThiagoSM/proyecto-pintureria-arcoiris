<?php
// Verificar si las cookies están configuradas
if (isset($_COOKIE['id_usuario']) && isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['correo']) && isset($_COOKIE['clasificacion'])) {
  // Obtener los valores desde las cookies
  $id_usuario = $_COOKIE['id_usuario'];
  $nombre_usuario = $_COOKIE['nombre_usuario'];
  $correo = $_COOKIE['correo'];
  $clasificacion = $_COOKIE['clasificacion'];
  $direccion = isset($_COOKIE['direccion']) ? $_COOKIE['direccion'] : '';
  $datos_contacto = isset($_COOKIE['datos_contacto']) ? $_COOKIE['datos_contacto'] : '';
  $fecha_nacimiento = isset($_COOKIE['fecha_nacimiento']) ? $_COOKIE['fecha_nacimiento'] : '';
  $cedula = isset($_COOKIE['cedula']) ? $_COOKIE['cedula'] : '';
  $foto_perfil = isset($_COOKIE['foto_perfil']) ? $_COOKIE['foto_perfil'] : '';
} else {
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

  <?php if (isset($_GET['success'])): ?>
    <script>
      alert("<?php echo htmlspecialchars($_GET['success']); ?>");
    </script>
  <?php endif; ?>

  <div class="profile">
    <form action="./codes/codeUserProfile.php" method="post" enctype="multipart/form-data" class="profile-container">
      <div class="profile-picture-section">
        <img class="user-profile-picture" src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Avatar" />
        <div class="action-buttons">
          <input type="file" id="profile_picture" name="foto_perfil" class="btn" />
        </div>
      </div>

      <div class="profile-details-section">
        <h2><?php echo htmlspecialchars($nombre_usuario); ?> <span class="user-role" style="font-size: 0.8em">(<?php echo htmlspecialchars($clasificacion); ?>)</span></h2>

        <?php
        // Array con los datos para generar los campos editables
        $fields = [
          "usuario" => ["label" => "Usuario", "name" => "nombre_usuario", "value" => $nombre_usuario],
          "direccion" => ["label" => "Dirección", "name" => "direccion", "value" => $direccion],
          "contacto" => ["label" => "Datos de Contacto", "name" => "datos_contacto", "value" => $datos_contacto],
          "fecha_nacimiento" => ["label" => "Fecha de Nacimiento", "name" => "fecha_nacimiento", "value" => $fecha_nacimiento, "type" => "date"]
        ];

        foreach ($fields as $id => $field) {
          $type = $field["type"] ?? "text"; // Usa "text" por defecto
        ?>
          <label for="<?php echo $id; ?>"><?php echo $field["label"]; ?>:</label>
          <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $field["name"]; ?>" value="<?php echo htmlspecialchars($field["value"]); ?>" disabled />
          <button type="button" onclick="enableInput('<?php echo $id; ?>')">
            <img src="path/to/edit-icon.png" alt="Editar" style="width: 16px; height: 16px;" />
          </button>
        <?php } ?>

        <div class="action-buttons">
          <button class="btn" type="submit">Guardar</button>
          <button class="btn">Cambiar contraseña</button>
          <form action="./codes/codeLogout.php" method="post">
            <button class="btn" type="submit">Salir</button>
          </form>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Función para habilitar el campo de entrada
    function enableInput(id) {
      document.getElementById(id).disabled = false;
      document.getElementById(id).focus();
    }
  </script>

  <?php include 'components/footer.php'; ?>
</body>

</html>