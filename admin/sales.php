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
            <div class="top-bar">
                <button class="active">Lista de Ventas</button>
                <div class="search-container">
                    <input type="date" id="search-date" class="search-bar">
                    <button onclick="buscarVenta()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="<?= (!isset($_GET['forma_de_pago']) || $_GET['forma_de_pago'] == '') ? 'active' : '' ?>" onclick="filtrarFormaPago('')">Todas</button>
                <button class="<?= (isset($_GET['forma_de_pago']) && $_GET['forma_de_pago'] == 'efectivo') ? 'active' : '' ?>" onclick="filtrarFormaPago('efectivo')">Efectivo</button>
                <button class="<?= (isset($_GET['forma_de_pago']) && $_GET['forma_de_pago'] == 'transferencia') ? 'active' : '' ?>" onclick="filtrarFormaPago('transferencia')">Transferencia</button>
            </div>

            <script>
                function filtrarFormaPago(formaPago) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('forma_de_pago', formaPago);
                    url.searchParams.delete('fecha_venta');
                    window.location.href = url;
                }

                function buscarVenta() {
                    const fechaVenta = document.getElementById('search-date').value;
                    const url = new URL(window.location.href);
                    if (fechaVenta) {
                        url.searchParams.set('fecha_venta', fechaVenta);
                    } else {
                        url.searchParams.delete('fecha_venta');
                    }
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
                        <th>Usuario</th>
                        <th>Producto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/codeSales.php'; ?>
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