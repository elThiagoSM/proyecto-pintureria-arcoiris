<?php
// Redirige a la página de inicio de sesión si no hay cookies de sesión activas
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
    <title>Procesar Ventas</title>
    <link rel="stylesheet" href="./styles/processSalesStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="process-sales-container">
        <?php include './components/header.php'; ?>

        <div class="process-sales-content">
            <div class="top-bar">
                <button class="active">Ventas en Proceso</button>
                <div class="search-container">
                    <select id="search-type" onchange="toggleSearchInput()">
                        <option value="id_venta">Buscar por ID Venta</option>
                        <option value="nombre_cliente">Buscar por Cliente</option>
                    </select>
                    <input type="text" id="search-input" placeholder="Buscar por ID Venta" class="search-bar">
                    <button onclick="buscarVenta()">Buscar</button>
                </div>
            </div>

            <script>
                function toggleSearchInput() {
                    const searchType = document.getElementById('search-type').value;
                    document.getElementById('search-input').placeholder = `Buscar por ${searchType === 'id_venta' ? 'ID Venta' : 'Cliente'}`;
                }

                function buscarVenta() {
                    const searchType = document.getElementById('search-type').value;
                    const searchValue = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);

                    if (searchType === 'id_venta' && searchValue) {
                        url.searchParams.set('id_venta', searchValue);
                        url.searchParams.delete('nombre_cliente');
                    } else if (searchType === 'nombre_cliente' && searchValue) {
                        url.searchParams.set('nombre_cliente', searchValue);
                        url.searchParams.delete('id_venta');
                    } else {
                        url.searchParams.delete('id_venta');
                        url.searchParams.delete('nombre_cliente');
                    }

                    window.location.href = url;
                }

                function confirmarVenta(idVenta) {
                    if (confirm("¿Estás seguro de que deseas completar esta venta?")) {
                        window.location.href = `./codes/codeProcessSales.php?action=confirm&id_venta=${idVenta}`;
                    }
                }

                function cancelarVenta(idVenta) {
                    if (confirm("¿Estás seguro de que deseas cancelar esta venta?")) {
                        window.location.href = `./codes/codeProcessSales.php?action=cancel&id_venta=${idVenta}`;
                    }
                }
            </script>

            <table class="process-sale-table">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>ID Cliente</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Valor de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/loadProcessSales.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&nombre_cliente=<?= $nombre_cliente ?>&id_venta=<?= $id_venta ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&nombre_cliente=<?= $nombre_cliente ?>&id_venta=<?= $id_venta ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>