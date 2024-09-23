<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pinturería Arcoiris</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <header class="header">
    <div class="header-container">
      <div class="logo">
        <img
          src="https://static.vecteezy.com/system/resources/thumbnails/012/986/755/small_2x/abstract-circle-logo-icon-free-png.png"
          alt="Logo Pinturería Arcoiris" />
      </div>

      <nav class="nav-menu">
        <ul>
          <li><a href="#">Pinturas</a></li>
          <li><a href="#">Accesorios</a></li>
          <li><a href="#">Herramientas</a></li>
          <li><a href="#">Contactos</a></li>
          
        </ul>
      </nav>

      <div class="search-bar">
        <input type="text" placeholder="Buscar..." />
      </div>

      <div class="action-buttons">
        <a href="login.php" button class="icon-button" aria-label="login">
        <i class="fa fa-sign-in-alt"></i>
        </a>
        <button class="icon-button"></button>
      </div>
    </div>
  </header>

  <section class="carousel">
    <div class="carousel-track">
      <div class="carousel-slide"><img src="https://f.fcdn.app/imgs/f8c5c5/www.pintelux.com/pintuy/ac79/webp/recursos/551/1440x300/pinturaaroma.jpg" alt="Slide 1"></div>
      <div class="carousel-slide"><img src="https://f.fcdn.app/imgs/4fcbed/www.pintelux.com/pintuy/f856/webp/recursos/547/1440x300/exteriores.jpg" alt="Slide 2"></div>
      <div class="carousel-slide"><img src="https://f.fcdn.app/imgs/a66fd9/www.pintelux.com/pintuy/d697/webp/recursos/664/1440x300/banner1440-1.jpg" alt="Slide 3"></div>
    </div>
  </section>

  <section class="featured-products">
    <h2>Productos Destacados</h2>
    <div class="products-grid">
      <div class="product">
        <img src="producto1.jpg" alt="Producto 1" />
        <p class="product-description">Descripción del producto 1</p>
        <p class="product-price">$29.99</p>
      </div>
      <div class="product">
        <img src="producto2.jpg" alt="Producto 2" />
        <p class="product-description">Descripción del producto 2</p>
        <p class="product-price">$39.99</p>
      </div>
      <div class="product">
        <img src="producto3.jpg" alt="Producto 3" />
        <p class="product-description">Descripción del producto 3</p>
        <p class="product-price">$49.99</p>
      </div>
      <div class="product">
        <img src="producto1.jpg" alt="Producto 1" />
        <p class="product-description">Descripción del producto 1</p>
        <p class="product-price">$29.99</p>
      </div>
      <div class="product">
        <img src="producto2.jpg" alt="Producto 2" />
        <p class="product-description">Descripción del producto 2</p>
        <p class="product-price">$39.99</p>
      </div>
      <div class="product">
        <img src="producto3.jpg" alt="Producto 3" />
        <p class="product-description">Descripción del producto 3</p>
        <p class="product-price">$49.99</p>
      </div>
      <div class="product">
        <img src="producto1.jpg" alt="Producto 1" />
        <p class="product-description">Descripción del producto 1</p>
        <p class="product-price">$29.99</p>
      </div>
      <div class="product">
        <img src="producto2.jpg" alt="Producto 2" />
        <p class="product-description">Descripción del producto 2</p>
        <p class="product-price">$39.99</p>
      </div>
      <div class="product">
        <img src="producto3.jpg" alt="Producto 3" />
        <p class="product-description">Descripción del producto 3</p>
        <p class="product-price">$49.99</p>
      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="footer-container">
      <div>
        <div class="footer-logo">
          <p>LOGO</p>
        </div>
        <div class="footer-social">
          <h4>Síguenos</h4>
          <div class="social-icons">
            <img src="facebook-icon.png" alt="Facebook" />
            <img src="instagram-icon.png" alt="Instagram" />
          </div>
        </div>
      </div>

      <div>
        <div>
          <div class="footer-branch">
            <h4>Sucursal</h4>
            <p>Salto, Uruguay 2297</p>
            <p>Lunes a Viernes 8:00 a 18:30 hs</p>
          </div>
          <div class="footer-payment">
            <h4>Medios de Pago</h4>
          </div>
        </div>

        <div>
          <div class="footer-contact">
            <h4>Contacto</h4>
            <p>*Contacto Atención telefónica: (+598)</p>
            <p>Correo electrónico:*</p>
          </div>
          <div class="footer-help">
            <h4>Ayuda</h4>
            <p>Términos y condiciones</p>
            <p>Preguntas frecuentes</p>
          </div>
        </div>
      </div>

    </div>
  </footer>

  <script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;

    function autoSlide() {
      currentIndex++;
      if (currentIndex >= totalSlides) {
        currentIndex = 0;
      }
      document.querySelector('.carousel-track').style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    setInterval(autoSlide, 3000);
  </script>
</body>

</html>