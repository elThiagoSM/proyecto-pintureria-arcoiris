<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pinturería Arcoiris</title>
  <link rel="stylesheet" href="css/indexStyles.css">

</head>

<body>
  <?php include 'components/header.php'; ?>
  <?php include './database/database.php'; ?>

  <div class="carousel-product-container">
    <section class="carousel">
      <div class="carousel-track">
        <div class="carousel-slide">
          <img
            src="./assets/imgs/slider/1.png"
            alt="Slide 1" />
        </div>
        <div class="carousel-slide">
          <img
            src="./assets/imgs/slider/2.png"
            alt="Slide 2" />
        </div>
        <div class="carousel-slide">
          <img
            src="./assets/imgs/slider/3.png"
            alt="Slide 3" />
        </div>
      </div>
    </section>

    <section class="product-types">
      <div class="product-type-grid">
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=exterior">
              <img
                src="./assets/imgs/productos/tarro-pintura.webp"
                alt="Pintura" />
              <p>Exterior</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=interior"><img
                src="./assets/imgs/productos/tarro-pintura.webp"
                alt="Esmalte" />
              <p>Interior</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=metal">
              <img
                src="./assets/imgs/productos/tarro-pintura.webp"
                alt="Barniz" />
              <p>Metal</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=madera">
              <img
                src="./assets/imgs/productos/tarro-pintura.webp"
                alt="Sellador" />
              <p>Madera</p>
            </a></li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=sintetica">
              <img
                src="./assets/imgs/productos/tarro-pintura.webp"
                alt="Impermeabilizante" />
              <p>Sintética</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=membrana">
              <img
                src="./assets/imgs/productos/tarro-pintura.webp"
                alt="Lacado" />
              <p>Membrana</p>
            </a>
          </li>
        </div>
      </div>
    </section>
  </div>

  <?php include 'components/featuredProducts.php'; ?>

  <?php include 'components/footer.php'; ?>

  <script src="./js/slider.js"> </script>
</body>

</html>