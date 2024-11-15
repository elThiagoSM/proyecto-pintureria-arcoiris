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
    <title>Paletas de Colores</title>
    <link rel="stylesheet" href="./styles/colorPaletteStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="color-palette-container">
        <?php include './components/header.php'; ?>

        <div class="color-palette-content">
            <div class="color-palette-header">
                <h1>Administrador de Paletas de Colores</h1>
            </div>

            <div class="top-bar">
                <button class='active'>Catálogo de paleta de colores</button>
                <div class="search-container">
                    <select id="search-type" onchange="toggleSearchInput()">
                        <option value="id">Buscar por ID</option>
                        <option value="nombre_color">Buscar por Nombre</option>
                    </select>
                    <input type="text" id="search-input" placeholder="Buscar:" class="search-bar">
                    <button onclick="buscarColor()">Buscar</button>
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

                function buscarColor() {
                    const searchType = document.getElementById('search-type').value;
                    const searchValue = document.getElementById('search-input').value;
                    const url = new URL(window.location.href);
                    url.searchParams.set('tipo_busqueda', searchType);
                    url.searchParams.set('busqueda', searchValue);
                    window.location.href = url;
                }

                function confirmarBorradoPaleta(idPaleta) {
                    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar esta paleta de colores?');
                    if (confirmDelete) {
                        fetch('./codes/deletes/deleteColorPalette.php', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    id_paleta: idPaleta,
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Paleta de colores eliminada exitosamente.');
                                    window.location.reload();
                                } else {
                                    alert(data.message || 'No se pudo eliminar la paleta de colores.');
                                }
                            })
                            .catch(error => {
                                console.error('Error al eliminar la paleta de colores:', error);
                                alert('Ocurrió un error al eliminar la paleta de colores.');
                            });
                    }
                }

                // Redirige a la página de nuevo color
                function redirigirANuevoColor() {
                    window.location.href = "newColorPalette.php";
                }
            </script>

            <table class="color-palette-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código de Color</th>
                        <th>Nombre</th>
                        <th>Tintes Utilizados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/loads/loadColorPalette.php'; ?>
                </tbody>
            </table>

            <div class="footer">
                <button onclick="redirigirANuevoColor()" class="new-color-palette">Nuevo Color</button>

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