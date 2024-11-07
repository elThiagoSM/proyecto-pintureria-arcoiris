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

                    <!-- Filtro por tipo de producto -->
                    <div class="filter-group">
                        <h3>Tipo de Producto</h3>
                        <ul>
                            <li><input type="radio" id="pinturas" name="tipo-producto" value="Pinturas"> <label for="pinturas">Pinturas</label></li>
                            <li><input type="radio" id="accesorios" name="tipo-producto" value="Accesorios"> <label for="accesorios">Accesorios</label></li>
                            <li><input type="radio" id="mini-ferreteria" name="tipo-producto" value="Mini-ferretería"> <label for="mini-ferreteria">Mini-ferretería</label></li>
                        </ul>
                    </div>

                    <!-- Filtro por marca -->
                    <div class="filter-group">
                        <h3>Marca</h3>
                        <ul>
                            <?php
                            include './database/database.php';
                            $marcasQuery = "SELECT DISTINCT marca FROM Productos WHERE marca IS NOT NULL";
                            $marcasResult = $conn->query($marcasQuery);

                            if ($marcasResult->num_rows > 0) {
                                while ($marcaRow = $marcasResult->fetch_assoc()) {
                                    $marca = htmlspecialchars($marcaRow['marca']);
                                    echo '<li><input type="checkbox" id="marca_' . $marca . '" name="marca[]" value="' . $marca . '"> <label for="marca_' . $marca . '">' . $marca . '</label></li>';
                                }
                            }
                            $marcasResult->free_result();
                            ?>
                        </ul>
                    </div>

                    <!-- Filtro por unidad -->
                    <div class="filter-group">
                        <h3>Unidad</h3>
                        <ul>
                            <li><input type="checkbox" id="litro" name="unidad[]" value="Litro"> <label for="litro">Litro</label></li>
                            <li><input type="checkbox" id="kg" name="unidad[]" value="Kg"> <label for="kg">Kg</label></li>
                            <li><input type="checkbox" id="cantidad" name="unidad[]" value="Cantidad"> <label for="cantidad">Cantidad</label></li>
                        </ul>
                    </div>

                    <!-- Filtro por precio -->
                    <div class="filter-group">
                        <h3>Precio</h3>
                        <input type="number" name="precio_min" placeholder="Min" value="1">
                        <input type="number" name="precio_max" placeholder="Max" value="5000">
                    </div>

                    <!-- Filtro por stock -->
                    <div class="filter-group">
                        <h3>Stock</h3>
                        <input type="checkbox" id="stock" name="stock" value="1"> <label for="stock">Mostrar solo productos en stock</label>
                    </div>

                    <!-- Filtro por terminacion (Solo Pinturas) -->
                    <div class="filter-group">
                        <h3>Terminación (Pinturas)</h3>
                        <ul>
                            <li><input type="radio" id="mate" name="terminacion" value="mate"> <label for="mate">Mate</label></li>
                            <li><input type="radio" id="brillante" name="terminacion" value="brillante"> <label for="brillante">Brillante</label></li>
                            <li><input type="radio" id="semimate" name="terminacion" value="semimate"> <label for="semimate">Semimate</label></li>
                            <li><input type="radio" id="satinada" name="terminacion" value="satinada"> <label for="satinada">Satinada</label></li>
                        </ul>
                    </div>

                    <!-- Filtro por funcion de aplicacion (Solo Pinturas) -->
                    <div class="filter-group">
                        <h3>Función de Aplicación (Pinturas)</h3>
                        <ul>
                            <li><input type="radio" id="exterior" name="funcion_aplicacion" value="exterior"> <label for="exterior">Exterior</label></li>
                            <li><input type="radio" id="interior" name="funcion_aplicacion" value="interior"> <label for="interior">Interior</label></li>
                            <li><input type="radio" id="metal" name="funcion_aplicacion" value="metal"> <label for="metal">Metal</label></li>
                            <li><input type="radio" id="madera" name="funcion_aplicacion" value="madera"> <label for="madera">Madera</label></li>
                            <li><input type="radio" id="sintetica" name="funcion_aplicacion" value="sintetica"> <label for="sintetica">Sintética</label></li>
                            <li><input type="radio" id="membrana" name="funcion_aplicacion" value="membrana"> <label for="membrana">Membrana</label></li>
                        </ul>
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