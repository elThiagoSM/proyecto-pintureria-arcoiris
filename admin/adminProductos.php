<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = $_POST['id_producto'] ?? '';
    $marca = $_POST['marca'] ?? '';
    $descripción = $_POST['descripción'] ?? '';
    $precio = $_POST['precio'] ?? 0;

    try {
        if ($accion === 'agregar') {
            $stmt = $conn->prepare("INSERT INTO productos (marca, descripción, precio) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Error en la consulta SQL (agregar): " . $conn->error);
            }
            $stmt->bind_param("ssd", $marca, $descripción, $precio);
            $stmt->execute();
            echo "<script>alert('Producto agregado correctamente.');</script>";
        } elseif ($accion === 'editar' && !empty($id)) {
            $stmt = $conn->prepare("UPDATE productos SET marca = ?, descripción = ?, precio = ? WHERE id_producto = ?");
            if (!$stmt) {
                throw new Exception("Error en la consulta SQL (editar): " . $conn->error);
            }
            $stmt->bind_param("ssdi", $marca, $descripción, $precio, $id);
            $stmt->execute();
            echo "<script>alert('Producto editado correctamente.');</script>";
        } elseif ($accion === 'eliminar' && !empty($id)) {
            $stmt = $conn->prepare("DELETE FROM productos WHERE id_producto = ?");
            if (!$stmt) {
                throw new Exception("Error en la consulta SQL (eliminar): " . $conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            echo "<script>alert('Producto eliminado correctamente.');</script>";
        } else {
            echo "<script>alert('Por favor, verifica los datos ingresados.');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error en la operación: " . $e->getMessage() . "');</script>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search_query'])) {
    // Proceso de búsqueda
    $search_query = $_GET['search_query'];
    $sql = "SELECT * FROM productos WHERE marca LIKE ? OR descripción LIKE ?";
    $stmt = $conn->prepare($sql);
    $like_query = '%' . $search_query . '%';
    $stmt->bind_param('ss', $like_query, $like_query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_producto']}</td><td>{$row['marca']}</td><td>{$row['descripción']}</td><td>{$row['precio']}</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron productos.";
    }
}

// Cerrar la conexión
$conn->close();
