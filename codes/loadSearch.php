<?php
include './database/database.php';

if (isset($_GET['query'])) {
    $searchQuery = '%' . $_GET['query'] . '%';
    $tipoFiltro = $_GET['tipo-producto'] ?? '';
    $marcasFiltro = $_GET['marca'] ?? [];
    $precioMin = (float)($_GET['precio_min'] ?? 1);
    $precioMax = (float)($_GET['precio_max'] ?? 5000);
    $unidadFiltro = $_GET['unidad'] ?? [];
    $stockFiltro = isset($_GET['stock']) ? true : false;
    $terminacionFiltro = $_GET['terminacion'] ?? '';
    $funcionAplicacionFiltro = $_GET['funcion_aplicacion'] ?? '';

    // Agregamos la condición `p.mostrar = 1` en la consulta principal
    $query = "SELECT p.id_producto, p.imagen, p.nombre, p.descripcion, p.precio 
              FROM productos p
              LEFT JOIN pinturas pt ON p.id_producto = pt.id_producto
              LEFT JOIN accesorios a ON p.id_producto = a.id_producto
              LEFT JOIN miniFerreteria mf ON p.id_producto = mf.id_producto
              WHERE p.mostrar = 1 
              AND p.nombre LIKE ? 
              AND p.precio BETWEEN ? AND ?";
    $bindTypes = 'sdd';
    $bindParams = [$searchQuery, $precioMin, $precioMax];

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
    $conn->close();
} else {
    echo "<p>No se proporcionó un término de búsqueda.</p>";
}
