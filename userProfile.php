<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Usuario</title>
  <link rel="stylesheet" href="css/userProfileStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
</head>

<body>
  <?php include 'components/header.php'; ?>

  <div class="profile">
    <div class="profile-container">
      <header class="profile-header">
        <h1><?php echo $_SESSION['nombre_usuario'] . ' (' . $_SESSION['clasificacion'] . ')'; ?></h1>
      </header>

      <section class="user-details">
        <div class="profile-pic-wrapper">
          <?php if (!empty($_SESSION['foto_perfil'])): ?>
            <img src="<?php echo $_SESSION['foto_perfil']; ?>" alt="<?php echo $_SESSION['nombre_cliente']; ?>" class="profile-pic" id="profile-pic-preview">
          <?php else: ?>
            <p>No disponible</p>
          <?php endif; ?>

          <input type="file" id="profile-image-input" name="profile_image" accept="image/*">

          <div id="cropModal" style="display:none;">
            <img id="image" style="max-width:100%;" alt="Imagen a recortar">
            <button id="cropButton">Recortar y Guardar</button>
          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
        <script src="js/editProfilePicture.js"> </script>

      </section>

      <?php if (isset($_SESSION['id_cliente'])): ?>
        <section class="client-details">
          <h2>Datos del Usuario</h2>
          <p><strong>Nombre del Cliente:</strong> <?php echo $_SESSION['nombre_cliente'] ?? 'No disponible'; ?></p>
          <p><strong>Usuario:</strong> <?php echo $_SESSION['nombre_usuario'] ?? 'No disponible'; ?></p>
          <p><strong>Correo:</strong> <?php echo $_SESSION['correo'] ?? 'No disponible'; ?></p>
          <p><strong>Dirección:</strong> <?php echo $_SESSION['direccion'] ?? 'No disponible'; ?></p>
          <p><strong>Datos de Contacto:</strong> <?php echo $_SESSION['datos_contacto'] ?? 'No disponible'; ?></p>
          <p><strong>Fecha de Nacimiento:</strong> <?php echo $_SESSION['fecha_nacimiento'] ?? 'No disponible'; ?></p>
          <p><strong>Cédula:</strong> <?php echo $_SESSION['cedula'] ?? 'No disponible'; ?></p>
        </section>
      <?php else: ?>
        <p class="no-client-data">No hay datos de cliente asociados a este usuario.</p>
      <?php endif; ?>

      <div class="action-buttons">
        <a href="codes/codeLogout.php" class="btn-logout">Cerrar Sesión</a>
        <a href="resetRequest.php" class="btn-edit">Cambiar contraseña</a>
      </div>
    </div>
  </div>

  <?php include 'components/footer.php'; ?>
</body>

</html>