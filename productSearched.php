<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Buscar Productos</title>
    <link rel="stylesheet" href="css/productSearchedStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="product-searched">
        <div class="product-searched-container">
            <div class="filters">
                <a href="#" class="back-button">Volver</a>

                <h2 class="product-name-searched">Nombre del producto</h2>
                <div class="filter-group">
                    <h3>Tipo de Producto</h3>
                    <ul>
                        <li><input type="radio" id="accesorios" name="tipo-producto"> <label for="accesorios">Accesorios</label></li>
                        <li><input type="radio" id="herramientas" name="tipo-producto"> <label for="herramientas">Herramientas</label></li>
                        <li><input type="radio" id="pinturas" name="tipo-producto"> <label for="pinturas">Pinturas</label></li>
                    </ul>
                </div>

                <div class="filter-group">
                    <h3>Marca</h3>
                    <ul>
                        <li><input type="checkbox" id="marca1"> <label for="marca1">Marca 1</label></li>
                        <li><input type="checkbox" id="marca2"> <label for="marca2">Marca 2</label></li>
                        <li><input type="checkbox" id="marca3"> <label for="marca3">Marca 3</label></li>
                        <li><input type="checkbox" id="marca4"> <label for="marca4">Marca 4</label></li>
                    </ul>
                </div>

                <div class="filter-group">
                    <h3>Características</h3>
                    <ul>
                        <li><input type="checkbox" id="altas-temp"> <label for="altas-temp">Altas temperaturas</label></li>
                        <li><input type="checkbox" id="lavables"> <label for="lavables">Lavables</label></li>
                        <li><input type="checkbox" id="sinteticas"> <label for="sinteticas">Sintéticas</label></li>
                    </ul>
                </div>

                <div class="filter-group">
                    <h3>Precio</h3>
                    <input type="range" min="0" max="1000" step="10" id="price-range">
                    <p>$000 UYU - 000 UYU</p>
                </div>

                <a href="#" class="back-button">Volver</a>
            </div>

            <section class="products">
                <div class="sorting">
                    <label for="sort">Ordenar por:</label>
                    <select id="sort">
                        <option value="relevancia">Relevancia</option>
                        <option value="barato">Más barato</option>
                        <option value="caro">Más caro</option>
                    </select>
                </div>

                <div class="product-list">
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                    <div class="product">
                        <img
                            src="https://static.wixstatic.com/media/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg/v1/fill/w_500,h_500,al_c,q_80,enc_auto/3f14c4_c83e5adf0f704f7289e3a08baf4301f9~mv2.jpg"
                            alt="Producto 1" />
                        <p class="product-description">Descripción del producto 1</p>
                        <p class="product-price">$29.99</p>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>