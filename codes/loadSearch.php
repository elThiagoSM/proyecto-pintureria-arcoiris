<?php
include './database/database.php'; // Conexion a la base de datos

// Verificar si hay un termino de busqueda
if (isset($_GET['query'])) {
    $searchQuery = '%' . $_GET['query'] . '%';

    // Iniciar variables para los filtros
    $tipoFiltro = isset($_GET['tipo-producto']) ? $_GET['tipo-producto'] : '';
    $marcaFiltro = isset($_GET['marca']) ? $_GET['marca'] : '';
    $precioMin = isset($_GET['precio_min']) ? $_GET['precio_min'] : 0;
    $precioMax = isset($_GET['precio_max']) ? $_GET['precio_max'] : 1000;

    // Crear la consulta con los filtros
    $query = "SELECT p.id_producto, p.imagen, p.descripción, p.precio 
              FROM Productos p
              LEFT JOIN Pinturas pt ON p.id_producto = pt.id_producto
              LEFT JOIN Accesorios a ON p.id_producto = a.id_producto
              LEFT JOIN Mini_ferreteria mf ON p.id_producto = mf.id_producto
              WHERE p.descripción LIKE ?
              AND p.precio BETWEEN ? AND ?";

    // Filtros dinamicos para tipo de producto y marca
    if (!empty($tipoFiltro)) {
        $query .= " AND p.tipo_productos = ?";
    }
    if (!empty($marcaFiltro)) {
        $query .= " AND p.marca = ?";
    }

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Enlazar parametros dependiendo de si hay filtros o no
    if (!empty($tipoFiltro) && !empty($marcaFiltro)) {
        $stmt->bind_param('sddss', $searchQuery, $precioMin, $precioMax, $tipoFiltro, $marcaFiltro);
    } elseif (!empty($tipoFiltro)) {
        $stmt->bind_param('sdds', $searchQuery, $precioMin, $precioMax, $tipoFiltro);
    } elseif (!empty($marcaFiltro)) {
        $stmt->bind_param('sdds', $searchQuery, $precioMin, $precioMax, $marcaFiltro);
    } else {
        $stmt->bind_param('sdd', $searchQuery, $precioMin, $precioMax);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar productos si hay resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<img src="' . $row['imagen'] . '" alt="Imagen de producto">';
            echo '<p class="product-description">' . $row['descripción'] . '</p>';
            echo '<p class="product-price">$' . $row['precio'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>No se encontraron productos que coincidan con la búsqueda.</p>";
    }

    // Cerrar la conexion y la consulta
    $stmt->close();
    $conn->close();
} else {
    echo "<p>No se proporcionó un término de búsqueda.</p>";
}
