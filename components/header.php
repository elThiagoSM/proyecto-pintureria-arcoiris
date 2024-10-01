<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header</title>
  <link rel="stylesheet" href="css/header.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
  <header class="header">
    <div class="header-container">
      <div class="logo">
        <a href="index.php">
          <img
            src="https://images.vexels.com/media/users/3/142789/isolated/preview/2bfb04ad814c4995f0c537c68db5cd0b-logotipo-de-c-rculo-de-remolinos-multicolor.png"
            alt="Logo Pinturería Arcoiris" />
        </a>
      </div>

      <nav class="nav-menu">
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="typesPaintings.php">Pinturas</a></li>
          <li><a href="accessories.php">Accesorios</a></li>
          <li><a href="tools.php">Herramientas</a></li>
        </ul>
      </nav>

      <form action="productSearched.php" method="GET" class="search-bar">
        <input type="text" name="query" placeholder="Buscar..." />
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>


      <div class="action-buttons">
        <?php
        // Verificar si las cookies de sesion estn configuradas
        if (isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['correo']) && isset($_COOKIE['clasificacion'])) {
          // Si las cookies estaj, redirigir al perfil de usuario
          echo '<a href="userProfile.php">
                    <button class="icon-button">
                      <i class="fas fa-user"></i>
                    </button>
                  </a>';
        } else {
          // Si no hay cookies redirigir al login
          echo '<a href="login.php">
                    <button class="icon-button">
                      <i class="fas fa-user"></i>
                    </button>
                  </a>';
        }
        ?>
        <button class="icon-button">
          <i class="fas fa-shopping-cart"></i>
        </button>
      </div>
    </div>
  </header>
</body>

</html>