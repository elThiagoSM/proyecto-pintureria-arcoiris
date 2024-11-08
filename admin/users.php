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
                    <input type="text" id="search-input" placeholder="Buscar:" class="search-bar">
                    <button onclick="buscarUsuario()">Buscar</button>
                </div>
            </div>

            <div class="categories">
                <button class="<?= (!isset($_GET['clasificacion']) || $_GET['clasificacion'] == '') ? 'active' : '' ?>" onclick="filtrarClasificacion('')">Todos</button>
                <button class="<?= (isset($_GET['clasificacion']) && $_GET['clasificacion'] == 'Cliente') ? 'active' : '' ?>" onclick="filtrarClasificacion('Cliente')">Clientes</button>
                <button class="<?= (isset($_GET['clasificacion']) && $_GET['clasificacion'] == 'Administrador') ? 'active' : '' ?>" onclick="filtrarClasificacion('Administrador')">Administradores</button>
            </div>

            <script>
                function filtrarClasificacion(clasificacion) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('clasificacion', clasificacion);
                    url.searchParams.delete('busqueda');
                    window.location.href = url;
                }

                function buscarUsuario() {
                    const busqueda = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('busqueda', busqueda);
                    window.location.href = url;
                }

                // Función para confirmar borrado
                function confirmarBorrado(idUsuario) {
                    document.getElementById('confirm-delete').style.display = 'block';
                    document.getElementById('delete-user-id').value = idUsuario;
                }

                function cancelarBorrado() {
                    document.getElementById('confirm-delete').style.display = 'none';
                }

                // Nueva función para redirigir a newAdmin.php
                function redirigirANuevoAdministrador() {
                    window.location.href = 'newAdmin.php';
                }
            </script>

            <!-- Modal de confirmación de borrado -->
            <div id="confirm-delete" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%); background-color:white; padding:20px; border:1px solid black; z-index:1000;">
                <p>¿Realmente quieres borrarlo?</p>
                <form method="POST">
                    <input type="hidden" id="delete-user-id" name="delete_id">
                    <button type="submit">Confirmar</button>
                    <button type="button" onclick="cancelarBorrado()">Cancelar</button>
                </form>
            </div>

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
                        <a href="?page=<?= $page - 1 ?>&clasificacion=<?= $clasificacion ?>&busqueda=<?= $busqueda ?>">Anterior</a>
                    <?php endif; ?>

                    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                    <?php if ($page < $totalPaginas): ?>
                        <a href="?page=<?= $page + 1 ?>&clasificacion=<?= $clasificacion ?>&busqueda=<?= $busqueda ?>">Siguiente</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

</body>

</html>