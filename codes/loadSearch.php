<?php
include './database/database.php';

try {
    if (!isset($_GET['query'])) {
        echo "<p>No se proporcionó un término de búsqueda.</p>";
        exit;
    }

    // Recuperar parametros de busqueda
    $searchQuery = '%' . $_GET['query'] . '%';
    $tipoFiltro = $_GET['tipo-producto'] ?? '';
    $marcasFiltro = $_GET['marca'] ?? [];
    $precioMin = isset($_GET['precio_min']) && is_numeric($_GET['precio_min']) ? (float)$_GET['precio_min'] : 0;
    $precioMax = isset($_GET['precio_max']) && is_numeric($_GET['precio_max']) ? (float)$_GET['precio_max'] : 999999;
    $unidadFiltro = $_GET['unidad'] ?? [];
    $stockFiltro = isset($_GET['stock']);
    $terminacionFiltro = $_GET['terminacion'] ?? '';
    $funcionAplicacionFiltro = $_GET['funcion_aplicacion'] ?? '';

    // Construir consulta base
    $query = "SELECT p.id_producto, p.imagen, p.nombre, p.descripcion, p.precio 
              FROM productos p
              LEFT JOIN pinturas pt ON p.id_producto = pt.id_producto
              LEFT JOIN accesorios a ON p.id_producto = a.id_producto
              LEFT JOIN miniferreteria mf ON p.id_producto = mf.id_producto
              WHERE (p.nombre LIKE ? OR p.descripcion LIKE ?)
              AND p.precio BETWEEN ? AND ?";
    $bindTypes = 'ssdd';
    $bindParams = [$searchQuery, $searchQuery, $precioMin, $precioMax];

    // Filtros adicionales
    if ($tipoFiltro) {
        switch ($tipoFiltro) {
            case 'Pinturas':
                $query .= " AND pt.id_producto IS NOT NULL";
                if ($terminacionFiltro) {
                    $query .= " AND pt.terminacion = ?";
                    $bindTypes .= 's';
                    $bindParams[] = $terminacionFiltro;
                }
                if ($funcionAplicacionFiltro) {
                    $query .= " AND pt.funcion_aplicacion = ?";
                    $bindTypes .= 's';
                    $bindParams[] = $funcionAplicacionFiltro;
                }
                break;
            case 'Accesorios':
                $query .= " AND a.id_producto IS NOT NULL";
                break;
            case 'Mini-ferretería':
                $query .= " AND mf.id_producto IS NOT NULL";
                break;
        }
    }

    if ($marcasFiltro) {
        $placeholders = implode(',', array_fill(0, count($marcasFiltro), '?'));
        $query .= " AND p.marca IN ($placeholders)";
        $bindTypes .= str_repeat('s', count($marcasFiltro));
        $bindParams = array_merge($bindParams, $marcasFiltro);
    }

    if ($unidadFiltro) {
        $placeholders = implode(',', array_fill(0, count($unidadFiltro), '?'));
        $query .= " AND p.unidad IN ($placeholders)";
        $bindTypes .= str_repeat('s', count($unidadFiltro));
        $bindParams = array_merge($bindParams, $unidadFiltro);
    }

    if ($stockFiltro) {
        $query .= " AND p.stock_cantidad > 0";
    }

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param($bindTypes, ...$bindParams);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="buyProduct.php?id_producto=' . htmlspecialchars($row['id_producto']) . '" class="product-link">';
            echo '<div class="product">';
            echo '<img src="' . htmlspecialchars($row['imagen']) . '" alt="Imagen de producto">';
            echo '<p class="product-name">' . htmlspecialchars($row['nombre']) . '</p>';
            echo '<p class="product-description">' . htmlspecialchars($row['descripcion']) . '</p>';
            echo '<p class="product-price">$' . htmlspecialchars($row['precio']) . '</p>';
            echo '</div>';
            echo '</a>';
        }
    } else {
        echo "<p>No se encontraron productos que coincidan con la búsqueda.</p>";
    }

    $stmt->close();
} catch (Exception $e) {
    echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

$conn->close();
