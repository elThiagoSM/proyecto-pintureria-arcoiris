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
    <title>Paleta de Colores</title>
    <link rel="stylesheet" href="./styles/colorPaletteStyles.css">
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="color-palette-container">
        <?php include './components/header.php'; ?>

        <div class="color-palette-content">
            <div class="top-bar">
                <h1>Paleta de Colores</h1>
                <button onclick="redirigirANuevaPaleta()" class="new-palette">Nueva Paleta</button>
            </div>

            <table class="palette-table">
                <thead>
                    <tr>
                        <th>Código de Color</th>
                        <th>Nombre</th>
                        <th>Tintes Utilizados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include './codes/loadColorPalette.php'; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">Anterior</a>
                <?php endif; ?>

                <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

                <?php if ($page < $totalPaginas): ?>
                    <a href="?page=<?= $page + 1 ?>">Siguiente</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function redirigirANuevaPaleta() {
            window.location.href = 'newColorPalette.php';
        }

        function confirmarBorrado(id_paleta) {
            if (confirm('¿Realmente quieres borrarlo?')) {
                window.location.href = `deleteColorPalette.php?id_paleta=${id_paleta}`;
            }
        }
    </script>
</body>

</html>