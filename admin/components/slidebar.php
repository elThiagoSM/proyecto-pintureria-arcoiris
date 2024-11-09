<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slidebar</title>
    <link rel="stylesheet" href="./styles/slidebarStyles.css">
</head>

<body>
    <div class="sidebar">
        <h1>PANEL</h1>
        <hr>
        <a href="dashboard.php" class="menu-item"><strong>Panel principal</strong></a>
        <hr>

        <div class="section">ADMINISTRACIÓN</div>
        <a href="users.php" class="menu-item">Clientes / Usuarios</a>
        <a href="products.php" class="menu-item">Productos</a>
        <a href="suppliers.php" class="menu-item">Proveedores</a>
        <a href="colorPalette.php" class="menu-item">Paleta de colores</a>
        <a href="sales.php" class="menu-item">Ventas</a>

        <div class="section">ESTADÍSTICAS</div>
        <a href="userRegistration.php" class="menu-item">Usuarios</a>
        <a href="saleRegistration.php" class="menu-item">Ventas</a>

        <hr>
        <div class="section">Local</div>
        <a href="processSales.php" class="menu-item">Procesar ventas</a>
    </div>
</body>

</html>