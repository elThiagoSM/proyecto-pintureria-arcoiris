<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Destacados</title>
    <link rel="stylesheet" href="css/featuredProductsStyles.css">
</head>

<body>
    <section class="featured-products">
        <h2>Productos Destacados</h2>
        <div class="products-grid">
            <?php include 'codes/loadFeaturedProducts.php'; ?>
        </div>
    </section>
</body>

</html>