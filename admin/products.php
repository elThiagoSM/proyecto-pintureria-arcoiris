<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es un administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['clasificacion'] !== 'Administrador') {
    // Si no es administrador o no está autenticado, redirigir al inicio de sesión
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
            <div class="top-bar">
                <button class="<?= !isset($_GET['categoria']) ? 'active' : '' ?>" onclick="filtrarCategoria('')">Catálogo de productos</button>
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Buscar:" class="search-bar">
                    <button onclick="buscarProducto()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="<?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Pinturas') ? 'active' : '' ?>" onclick="filtrarCategoria('Pinturas')">Pinturas</button>
                <button class="<?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Accesorios') ? 'active' : '' ?>" onclick="filtrarCategoria('Accesorios')">Accesorios</button>
                <button class="<?= (isset($_GET['categoria']) && $_GET['categoria'] == 'Mini Ferretería') ? 'active' : '' ?>" onclick="filtrarCategoria('Mini Ferretería')">Mini Ferretería</button>
                <button class="<?= (!isset($_GET['categoria']) || $_GET['categoria'] == '') ? 'active' : '' ?>" onclick="filtrarCategoria('')">Todos</button>
            </div>

            <script>
                function filtrarCategoria(categoria) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('categoria', categoria);
                    url.searchParams.delete('busqueda');
                    window.location.href = url;
                }

                function buscarProducto() {
                    const busqueda = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('busqueda', busqueda);
                    window.location.href = url;
                }

                // Nueva función para redirigir a newProduct.php
                function redirigirANuevoProducto() {
                    window.location.href = 'newProduct.php';
                }
            </script>

            <div id="confirm-delete" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%); background-color:white; padding:20px; border:1px solid black; z-index:1000;">
                <p>¿Realmente quieres borrarlo?</p>
                <form method="POST">
                    <input type="hidden" id="delete-product-id" name="delete_id">
                    <button type="submit">Confirmar</button>
                    <button type="button" onclick="cancelarBorrado()">Cancelar</button>
                </form>
            </div>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Disponibles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/codeProducts.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <!-- Cambiar este botón "Nuevo" también para redirigir a newProduct.php -->
                <button onclick="redirigirANuevoProducto()" class="new-product">Nuevo</button>

                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&categoria=<?= $categoria ?>&busqueda=<?= $busqueda ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&categoria=<?= $categoria ?>&busqueda=<?= $busqueda ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

</body>

</html>