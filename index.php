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
            src="https://f.fcdn.app/imgs/f8c5c5/www.pintelux.com/pintuy/ac79/webp/recursos/551/1440x300/pinturaaroma.jpg"
            alt="Slide 1" />
        </div>
        <div class="carousel-slide">
          <img
            src="https://f.fcdn.app/imgs/4fcbed/www.pintelux.com/pintuy/f856/webp/recursos/547/1440x300/exteriores.jpg"
            alt="Slide 2" />
        </div>
        <div class="carousel-slide">
          <img
            src="https://f.fcdn.app/imgs/a66fd9/www.pintelux.com/pintuy/d697/webp/recursos/664/1440x300/banner1440-1.jpg"
            alt="Slide 3" />
        </div>
      </div>
    </section>

    <section class="product-types">
      <div class="product-type-grid">
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=exterior">
              <img
                src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                alt="Pintura" />
              <p>Exterior</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=interior"><img
                src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                alt="Esmalte" />
              <p>Interior</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=metal">
              <img
                src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                alt="Barniz" />
              <p>Metal</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=madera">
              <img
                src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                alt="Sellador" />
              <p>Madera</p>
            </a></li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=sintetica">
              <img
                src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                alt="Impermeabilizante" />
              <p>Sintética</p>
            </a>
          </li>
        </div>
        <div class="product-type">
          <li><a href="productSearched.php?query=<?php echo urlencode($_GET['query'] ?? ''); ?>&funcion_aplicacion=membrana">
              <img
                src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
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

  <script src="./java/slider.js"> </script>
</body>

</html>