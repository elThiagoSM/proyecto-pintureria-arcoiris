<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="./styles/suppliersStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="suppliers-container">
        <?php include './components/header.php'; ?>

        <div class="suppliers-content">
            <div class="suppliers-header">
                <h1>Administrador de Proveedores</h1>
            </div>

            <div class="top-bar">
                <button class="active">Lista de Proveedores</button>
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Buscar:" class="search-bar">
                    <button onclick="buscarProveedor()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="active">Todos</button>
            </div>

            <script>
                function buscarProveedor() {
                    const busqueda = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('busqueda', busqueda);
                    window.location.href = url;
                }

                // Función para confirmar borrado
                function confirmarBorrado(idProveedor) {
                    document.getElementById('confirm-delete').style.display = 'block';
                    document.getElementById('delete-supplier-id').value = idProveedor;
                }

                function cancelarBorrado() {
                    document.getElementById('confirm-delete').style.display = 'none';
                }
            </script>

            <!-- Modal de confirmación de borrado -->
            <div id="confirm-delete" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%); background-color:white; padding:20px; border:1px solid black; z-index:1000;">
                <p>¿Realmente quieres borrarlo?</p>
                <form method="POST">
                    <input type="hidden" id="delete-supplier-id" name="delete_id">
                    <button type="submit">Confirmar</button>
                    <button type="button" onclick="cancelarBorrado()">Cancelar</button>
                </form>
            </div>

            <table class="supplier-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/codeSuppliers.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <button class="new-supplier">Nuevo Proveedor</button>

                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&busqueda=<?= $busqueda ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&busqueda=<?= $busqueda ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>