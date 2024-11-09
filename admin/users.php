<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="./styles/usersStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="users-container">
        <?php include './components/header.php'; ?>

        <div class="users-content">
            <div class="top-bar">
                <button class="active">Lista de Usuarios</button>
                <div class="search-container">
                    <select id="search-type" onchange="toggleSearchInput()">
                        <option value="id">Buscar por ID</option>
                        <option value="nombre">Buscar por Nombre</option>
                        <option value="correo">Buscar por Correo</option>
                    </select>
                    <input type="text" id="search-input" placeholder="Buscar..." class="search-bar">
                    <button onclick="buscarUsuario()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="<?= (!isset($_GET['clasificacion']) || $_GET['clasificacion'] == '') ? 'active' : '' ?>" onclick="filtrarClasificacion('')">Todos</button>
                <button class="<?= (isset($_GET['clasificacion']) && $_GET['clasificacion'] == 'Cliente') ? 'active' : '' ?>" onclick="filtrarClasificacion('Cliente')">Clientes</button>
                <button class="<?= (isset($_GET['clasificacion']) && $_GET['clasificacion'] == 'Administrador') ? 'active' : '' ?>" onclick="filtrarClasificacion('Administrador')">Administradores</button>
            </div>

            <script>
                function toggleSearchInput() {
                    // Cambiar el texto del campo de búsqueda según el tipo seleccionado
                    const searchType = document.getElementById('search-type').value;
                    document.getElementById('search-input').placeholder = `Buscar por ${searchType.charAt(0).toUpperCase() + searchType.slice(1)}`;
                }

                function buscarUsuario() {
                    const searchType = document.getElementById('search-type').value;
                    const searchValue = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);

                    // Configurar los parámetros de búsqueda
                    url.searchParams.set('tipo_busqueda', searchType);
                    url.searchParams.set('busqueda', searchValue);
                    window.location.href = url;
                }

                function filtrarClasificacion(clasificacion) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('clasificacion', clasificacion);
                    url.searchParams.delete('tipo_busqueda');
                    url.searchParams.delete('busqueda');
                    window.location.href = url;
                }

                function redirigirANuevoAdministrador() {
                    window.location.href = 'newAdmin.php';
                }
            </script>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Clasificación</th>
                        <th>Fecha de Ingreso</th>
                        <th>Última Actualización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/codeUsers.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <button onclick="redirigirANuevoAdministrador()" class="new-user">Nuevo Admin</button>

                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>&clasificacion=<?= $clasificacion ?>&tipo_busqueda=<?= $tipo_busqueda ?>&busqueda=<?= $busqueda ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&clasificacion=<?= $clasificacion ?>&tipo_busqueda=<?= $tipo_busqueda ?>&busqueda=<?= $busqueda ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>