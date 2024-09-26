<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Producto</title>
    <link rel="stylesheet" href="css/buyProductStyles.css">
</head>

<body>
    <?php include 'components/header.html'; ?>

    <div class="buy-product">
        <div class="buy-product-container">
            <div class="image-container">
                <img src="https://via.placeholder.com/800x600" alt="Imagen del Producto">
            </div>

            <div class="details">
                <div class="details-text">
                    <h2>Nombre del producto</h2>
                    <p>Descripción del producto</p>
                    <p>$000</p>
                </div>

                <div class="buttons">
                    <button class="buy">COMPRAR AHORA</button>
                    <button class="add-to-cart">AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/featuredProducts.html'; ?>

    <?php include 'components/footer.html'; ?>
</body>

</html>