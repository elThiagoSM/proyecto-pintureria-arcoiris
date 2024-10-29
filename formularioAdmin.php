<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Productos</title>
</head>
<body>
    <h1>Administración de Productos</h1>

    <!-- Formulario para Agregar/Editar un Producto -->
    <form action="codes/adminProductos.php" method="POST">
        <label for="id_producto">ID (para editar o eliminar):</label>
        <input type="text" id="id_producto" name="id_producto"><br>

        <label for="marca">Marca del Producto:</label>
        <input type="text" id="marca" name="marca" required><br>

        <label for="descripción">Descripción:</label>
        <input type="text" id="descripción" name="descripción" required><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required step="0.01"><br>

        <button type="submit" name="accion" value="agregar">Agregar Producto</button>
        <button type="submit" name="accion" value="editar">Editar Producto</button>
        <button type="submit" name="accion" value="eliminar">Eliminar Producto</button>
    </form>

    <h2>Lista de Productos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>marca</th>
            <th>Categoría</th>
            <th>Precio</th>
        </tr>
        <?php
        include 'database/database.php';

        // Ejecutar consulta con mysqli
        $result = $conn->query('SELECT * FROM productos');
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id_producto']}</td><td>{$row['marca']}</td><td>{$row['descripción']}</td><td>{$row['precio']}</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Error al obtener los datos</td></tr>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </table>
</body>
</html>
