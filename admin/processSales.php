<?php
// Verificar si las cookies están configuradas y si el usuario es un administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
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