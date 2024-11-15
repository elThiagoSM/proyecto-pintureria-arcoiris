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
    <title>Ventas</title>
    <link rel="stylesheet" href="./styles/salesStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="sales-container">
        <?php include './components/header.php'; ?>

        <div class="sales-content">
            <div class="sales-header">
                <h1>Administrador de Ventas</h1>
            </div>

            <div class="top-bar">
                <button class="active">Lista de Ventas</button>
                <div class="search-container">
                    <select id="search-type" onchange="toggleSearchInput()">
                        <option value="fecha">Buscar por Fecha</option>
                        <option value="id">Buscar por ID de Venta</option>
                    </select>
                    <input type="date" id="search-date" class="search-bar" style="display: inline;">
                    <input type="number" id="search-id" class="search-bar" style="display: none;" placeholder="ID de Venta">
                    <button onclick="buscarVenta()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="<?= (!isset($_GET['forma_de_pago']) || $_GET['forma_de_pago'] == '') ? 'active' : '' ?>" onclick="filtrarFormaPago('')">Todas</button>
                <button class="<?= (isset($_GET['forma_de_pago']) && $_GET['forma_de_pago'] == 'efectivo') ? 'active' : '' ?>" onclick="filtrarFormaPago('efectivo')">Efectivo</button>
                <button class="<?= (isset($_GET['forma_de_pago']) && $_GET['forma_de_pago'] == 'transferencia') ? 'active' : '' ?>" onclick="filtrarFormaPago('transferencia')">Transferencia</button>
            </div>

            <script>
                // Alternar el campo de entrada según el tipo de búsqueda seleccionado
                function toggleSearchInput() {
                    const searchType = document.getElementById('search-type').value;
                    document.getElementById('search-date').style.display = searchType === 'fecha' ? 'inline' : 'none';
                    document.getElementById('search-id').style.display = searchType === 'id' ? 'inline' : 'none';
                }

                // Función para buscar venta
                function buscarVenta() {
                    const searchType = document.getElementById('search-type').value;
                    const url = new URL(window.location.href);

                    if (searchType === 'fecha') {
                        const fechaVenta = document.getElementById('search-date').value;
                        if (fechaVenta) {
                            url.searchParams.set('fecha_venta', fechaVenta);
                            url.searchParams.delete('id_venta'); // Eliminar parámetro de id si existe
                        }
                    } else if (searchType === 'id') {
                        const idVenta = document.getElementById('search-id').value;
                        if (idVenta) {
                            url.searchParams.set('id_venta', idVenta);
                            url.searchParams.delete('fecha_venta'); // Eliminar parámetro de fecha si existe
                        }
                    }
                    window.location.href = url;
                }

                function filtrarFormaPago(formaPago) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('forma_de_pago', formaPago);
                    url.searchParams.delete('fecha_venta');
                    url.searchParams.delete('id_venta');
                    window.location.href = url;
                }
            </script>

            <table class="sale-table">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Forma de Pago</th>
                        <th>Fecha de Venta</th>
                        <th>Valor de Venta</th>
                        <th>Estado</th>
                        <th>Notas</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/loads/loadSales.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&forma_de_pago=<?= $forma_de_pago ?>&fecha_venta=<?= $fecha_venta ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&forma_de_pago=<?= $forma_de_pago ?>&fecha_venta=<?= $fecha_venta ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>