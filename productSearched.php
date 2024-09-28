<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Productos</title>
    <link rel="stylesheet" href="css/productSearchedStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="product-searched">
        <div class="product-searched-container">
            <div class="filters">
                <a href="#" class="back-button">Volver</a>
                <h2 class="product-name-searched">Resultados para: "<?php echo htmlspecialchars($_GET['query'] ?? ''); ?>"</h2>

                <form method="GET" action="productSearched.php">
                    <input type="hidden" name="query" value="<?php echo htmlspecialchars($_GET['query'] ?? ''); ?>">

                    <div class="filter-group">
                        <h3>Tipo de Producto</h3>
                        <ul>
                            <li><input type="radio" id="pinturas" name="tipo-producto" value="Pinturas"> <label for="pinturas">Pinturas</label></li>
                            <li><input type="radio" id="accesorios" name="tipo-producto" value="Accesorios"> <label for="accesorios">Accesorios</label></li>
                            <li><input type="radio" id="mini-ferreteria" name="tipo-producto" value="Mini-ferretería"> <label for="mini-ferreteria">Mini-ferretería</label></li>
                        </ul>
                    </div>

                    <div class="filter-group">
                        <h3>Marca</h3>
                        <ul>
                            <li><input type="checkbox" id="marca1" name="marca" value="Marca 1"> <label for="marca1">Marca 1</label></li>
                            <li><input type="checkbox" id="marca2" name="marca" value="Marca 2"> <label for="marca2">Marca 2</label></li>
                            <li><input type="checkbox" id="marca3" name="marca" value="Marca 3"> <label for="marca3">Marca 3</label></li>
                        </ul>
                    </div>

                    <div class="filter-group">
                        <h3>Precio</h3>
                        <input type="number" name="precio_min" placeholder="Min" value="0">
                        <input type="number" name="precio_max" placeholder="Max" value="1000">
                    </div>

                    <button type="submit">Aplicar Filtros</button>
                </form>
            </div>

            <section class="products">
                <div class="product-list">
                    <?php include 'codes/loadSearch.php'; ?>
                </div>
            </section>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>