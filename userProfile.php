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
</head>

<body>
  <?php include 'components/header.php'; ?>

  <div class="profile">
    <div class="profile-container">
      <!-- Nombre y clasificación del usuario -->
      <header class="profile-header">
        <h1><?php echo $_SESSION['nombre_usuario'] . ' (' . $_SESSION['clasificacion'] . ')'; ?></h1>
      </header>

      <!-- Detalles del usuario -->
      <section class="user-details">
        <div class="profile-pic-wrapper">
          <?php if (!empty($_SESSION['foto_perfil'])): ?>
            <img src="<?php echo $_SESSION['foto_perfil']; ?>" alt="Foto de perfil" class="profile-pic">
          <?php else: ?>
            <p>No disponible</p>
          <?php endif; ?>

          <!-- Botón para cambiar la foto -->
          <button class="btn-change-photo">Cambiar Foto</button>
        </div>
      </section>

      <!-- Detalles del cliente si existen -->
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

      <!-- Botones de Cerrar Sesión y Editar -->
      <div class="action-buttons">
        <a href="codes/codeLogout.php" class="btn-logout">Cerrar Sesión</a>
        <button class="btn-edit">Editar Datos</button>
      </div>
    </div>
  </div>

  <?php include 'components/footer.php'; ?>
</body>

</html>