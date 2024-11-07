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
                    <input type="text" id="search-client" placeholder="Buscar por Cliente" class="search-bar">
                    <button onclick="buscarCliente()">Buscar</button>
                </div>
            </div>

            <script>
                function buscarCliente() {
                    const nombreCliente = document.getElementById('search-client').value;
                    const url = new URL(window.location.href);
                    if (nombreCliente) {
                        url.searchParams.set('nombre_cliente', nombreCliente);
                    } else {
                        url.searchParams.delete('nombre_cliente');
                    }
                    window.location.href = url;
                }
            </script>

            <table class="process-sale-table">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Cliente</th>
                        <th>Producto</th>
                        <th>Valor de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/codeProcessSales.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&nombre_cliente=<?= $nombre_cliente ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&nombre_cliente=<?= $nombre_cliente ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>