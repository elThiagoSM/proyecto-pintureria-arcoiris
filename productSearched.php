<?php
session_start();
?>
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
                            <li><input type="radio" id="pinturas" name="tipo-producto" value="Pinturas" <?php echo (isset($_GET['tipo-producto']) && $_GET['tipo-producto'] == 'Pinturas') ? 'checked' : ''; ?>> <label for="pinturas">Pinturas</label></li>
                            <li><input type="radio" id="accesorios" name="tipo-producto" value="Accesorios" <?php echo (isset($_GET['tipo-producto']) && $_GET['tipo-producto'] == 'Accesorios') ? 'checked' : ''; ?>> <label for="accesorios">Accesorios</label></li>
                            <li><input type="radio" id="mini-ferreteria" name="tipo-producto" value="Mini-ferretería" <?php echo (isset($_GET['tipo-producto']) && $_GET['tipo-producto'] == 'Mini-ferretería') ? 'checked' : ''; ?>> <label for="mini-ferreteria">Mini-ferretería</label></li>
                        </ul>
                    </div>

                    <!-- Filtro por marca -->
                    <div class="filter-group">
                        <h3>Marca</h3>
                        <ul>
                            <?php
                            include './database/database.php';
                            $marcasQuery = "SELECT DISTINCT marca FROM productos WHERE marca IS NOT NULL";
                            $marcasResult = $conn->query($marcasQuery);

                            if ($marcasResult->num_rows > 0) {
                                while ($marcaRow = $marcasResult->fetch_assoc()) {
                                    $marca = htmlspecialchars($marcaRow['marca']);
                                    echo '<li><input type="checkbox" id="marca_' . $marca . '" name="marca[]" value="' . $marca . '" ' . (isset($_GET['marca']) && in_array($marca, $_GET['marca']) ? 'checked' : '') . '> <label for="marca_' . $marca . '">' . $marca . '</label></li>';
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
                            <li><input type="checkbox" id="litro" name="unidad[]" value="Litro" <?php echo (isset($_GET['unidad']) && in_array('Litro', $_GET['unidad'])) ? 'checked' : ''; ?>> <label for="litro">Litro</label></li>
                            <li><input type="checkbox" id="kg" name="unidad[]" value="Kg" <?php echo (isset($_GET['unidad']) && in_array('Kg', $_GET['unidad'])) ? 'checked' : ''; ?>> <label for="kg">Kg</label></li>
                            <li><input type="checkbox" id="cantidad" name="unidad[]" value="Cantidad" <?php echo (isset($_GET['unidad']) && in_array('Cantidad', $_GET['unidad'])) ? 'checked' : ''; ?>> <label for="cantidad">Cantidad</label></li>
                        </ul>
                    </div>

                    <!-- Filtro por precio -->
                    <div class="filter-group">
                        <h3>Precio</h3>
                        <input type="number" name="precio_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['precio_min'] ?? ''); ?>">
                        <input type="number" name="precio_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['precio_max'] ?? ''); ?>">
                    </div>

                    <!-- Filtro por stock -->
                    <div class="filter-group">
                        <h3>Stock</h3>
                        <input type="checkbox" id="stock" name="stock" value="1" <?php echo isset($_GET['stock']) ? 'checked' : ''; ?>> <label for="stock">Mostrar solo productos en stock</label>
                    </div>

                    <!-- Filtro por terminacion (Solo Pinturas) -->
                    <div class="filter-group">
                        <h3>Terminación (Pinturas)</h3>
                        <ul>
                            <li><input type="radio" id="mate" name="terminacion" value="mate" <?php echo (isset($_GET['terminacion']) && $_GET['terminacion'] == 'mate') ? 'checked' : ''; ?>> <label for="mate">Mate</label></li>
                            <li><input type="radio" id="brillante" name="terminacion" value="brillante" <?php echo (isset($_GET['terminacion']) && $_GET['terminacion'] == 'brillante') ? 'checked' : ''; ?>> <label for="brillante">Brillante</label></li>
                            <li><input type="radio" id="semimate" name="terminacion" value="semimate" <?php echo (isset($_GET['terminacion']) && $_GET['terminacion'] == 'semimate') ? 'checked' : ''; ?>> <label for="semimate">Semimate</label></li>
                            <li><input type="radio" id="satinada" name="terminacion" value="satinada" <?php echo (isset($_GET['terminacion']) && $_GET['terminacion'] == 'satinada') ? 'checked' : ''; ?>> <label for="satinada">Satinada</label></li>
                        </ul>
                    </div>

                    <!-- Filtro por funcion de aplicacion (Solo Pinturas) -->
                    <div class="filter-group">
                        <h3>Función de Aplicación (Pinturas)</h3>
                        <ul>
                            <li><input type="radio" id="exterior" name="funcion_aplicacion" value="exterior" <?php echo (isset($_GET['funcion_aplicacion']) && $_GET['funcion_aplicacion'] == 'exterior') ? 'checked' : ''; ?>> <label for="exterior">Exterior</label></li>
                            <li><input type="radio" id="interior" name="funcion_aplicacion" value="interior" <?php echo (isset($_GET['funcion_aplicacion']) && $_GET['funcion_aplicacion'] == 'interior') ? 'checked' : ''; ?>> <label for="interior">Interior</label></li>
                            <li><input type="radio" id="metal" name="funcion_aplicacion" value="metal" <?php echo (isset($_GET['funcion_aplicacion']) && $_GET['funcion_aplicacion'] == 'metal') ? 'checked' : ''; ?>> <label for="metal">Metal</label></li>
                            <li><input type="radio" id="madera" name="funcion_aplicacion" value="madera" <?php echo (isset($_GET['funcion_aplicacion']) && $_GET['funcion_aplicacion'] == 'madera') ? 'checked' : ''; ?>> <label for="madera">Madera</label></li>
                            <li><input type="radio" id="sintetica" name="funcion_aplicacion" value="sintetica" <?php echo (isset($_GET['funcion_aplicacion']) && $_GET['funcion_aplicacion'] == 'sintetica') ? 'checked' : ''; ?>> <label for="sintetica">Sintética</label></li>
                            <li><input type="radio" id="membrana" name="funcion_aplicacion" value="membrana" <?php echo (isset($_GET['funcion_aplicacion']) && $_GET['funcion_aplicacion'] == 'membrana') ? 'checked' : ''; ?>> <label for="membrana">Membrana</label></li>
                        </ul>
                    </div>

                    <button class="apply-filters-button" type="submit">Aplicar Filtros</button>
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