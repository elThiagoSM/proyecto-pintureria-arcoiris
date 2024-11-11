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
                    <select id="search-type" onchange="toggleSearchInput()">
                        <option value="id">Buscar por ID</option>
                        <option value="nombre">Buscar por Nombre</option>
                        <option value="telefono">Buscar por Teléfono</option>
                        <option value="correo">Buscar por Correo</option>
                    </select>
                    <input type="text" id="search-input" placeholder="Buscar..." class="search-bar">
                    <button onclick="buscarProveedor()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="active">Todos</button>
            </div>

            <script>
                function toggleSearchInput() {
                    const searchType = document.getElementById('search-type').value;
                    document.getElementById('search-input').placeholder = `Buscar por ${searchType.charAt(0).toUpperCase() + searchType.slice(1)}`;
                }

                function buscarProveedor() {
                    const searchType = document.getElementById('search-type').value;
                    const searchValue = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);

                    url.searchParams.set('tipo_busqueda', searchType);
                    url.searchParams.set('busqueda', searchValue);
                    window.location.href = url;
                }

                function confirmarBorrado(idProveedor) {
                    document.getElementById('confirm-delete').style.display = 'block';
                    document.getElementById('delete-supplier-id').value = idProveedor;
                }

                function cancelarBorrado() {
                    document.getElementById('confirm-delete').style.display = 'none';
                }

                function redirigirANuevoProveedor() {
                    window.location.href = 'newSupplier.php';
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
                    <?php include './codes/loadSuppliers.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <button onclick="redirigirANuevoProveedor()" class="new-supplier">Nuevo Proveedor</button>

                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&tipo_busqueda=<?= $tipo_busqueda ?>&busqueda=<?= $busqueda ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&tipo_busqueda=<?= $tipo_busqueda ?>&busqueda=<?= $busqueda ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>