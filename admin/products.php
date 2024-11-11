<?php
// Verificar si las cookies están configuradas y si el usuario es un administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="./styles/productsStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="products-container">
        <?php include './components/header.php'; ?>

        <div class="products-content">
            <div class="products-header">
                <h1>Administrador de Productos</h1>
            </div>

            <div class="top-bar">
                <button class="<?= !isset($_GET['categoria']) ? 'active' : '' ?>" onclick="filtrarCategoria('')">Catálogo de productos</button>
                <div class="search-container">
                    <select id="search-type" onchange="toggleSearchInput()">
                        <option value="id">Buscar por ID</option>
                        <option value="nombre">Buscar por Nombre</option>
                    </select>
                    <input type="text" id="search-input" placeholder="Buscar:" class="search-bar">
                    <button onclick="buscarProducto()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="<?= (!isset($_GET['categoria']) || $_GET['categoria'] == '') ? 'active' : '' ?>" onclick="filtrarCategoria('')">Todos</button>
                <button class="<?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Pinturas') ? 'active' : '' ?>" onclick="filtrarCategoria('Pinturas')">Pinturas</button>
                <button class="<?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Accesorios') ? 'active' : '' ?>" onclick="filtrarCategoria('Accesorios')">Accesorios</button>
                <button class="<?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Mini Ferretería') ? 'active' : '' ?>" onclick="filtrarCategoria('Mini Ferretería')">Mini Ferretería</button>
            </div>

            <script>
                function toggleSearchInput() {
                    const searchType = document.getElementById('search-type').value;
                    document.getElementById('search-input').placeholder = `Buscar por ${searchType.charAt(0).toUpperCase() + searchType.slice(1)}`;
                }

                function buscarProducto() {
                    const searchType = document.getElementById('search-type').value;
                    const searchValue = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('tipo_busqueda', searchType);
                    url.searchParams.set('busqueda', searchValue);
                    window.location.href = url;
                }

                function filtrarCategoria(categoria) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('categoria', categoria);
                    url.searchParams.delete('busqueda');
                    url.searchParams.delete('tipo_busqueda');
                    window.location.href = url;
                }

                // Redirige a la página de nuevo producto
                function redirigirANuevoProducto() {
                    window.location.href = "newProduct.php";
                }
            </script>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Disponibles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/loadProducts.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <button onclick="redirigirANuevoProducto()" class="new-product">Nuevo</button>

                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&categoria=<?= $categoria ?>&tipo_busqueda=<?= $tipo_busqueda ?>&busqueda=<?= $busqueda ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&categoria=<?= $categoria ?>&tipo_busqueda=<?= $tipo_busqueda ?>&busqueda=<?= $busqueda ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

</body>

</html>