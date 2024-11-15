<?php
include './database/database.php';

// Configuración de paginación
$paintingsPerPage = 10;  // Número de pinturas por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Página actual, por defecto es 1
$offset = ($page - 1) * $paintingsPerPage;  // Calcular el desplazamiento

// Consulta con LIMIT y OFFSET para la paginación, y filtrado por `mostrar = 1`
$query = "SELECT p.id_producto, p.imagen, p.nombre, p.descripcion, p.precio 
          FROM productos p
          INNER JOIN pinturas pt ON p.id_producto = pt.id_producto
          WHERE p.mostrar = 1
          LIMIT ? OFFSET ?";

// Prepara la consulta
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $paintingsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="gallery">';

    // Mostrar las pinturas en la página actual
    while ($row = $result->fetch_assoc()) {
        echo '<a href="buyProduct.php?id_producto=' . $row['id_producto'] . '" class="paint-type-link">';
        echo '<div class="paint-type">';
        echo '<img src="' . $row['imagen'] . '" alt="' . $row['descripcion'] . '">';
        echo '<p class="product-name">' . $row['nombre'] . '</p>';
        echo '<p class="product-description">' . $row['descripcion'] . '</p>';
        echo '<p class="product-price">$' . $row['precio'] . '</p>';
        echo '</div>';
        echo '</a>';
    }

    echo '</div>';

    // Consulta para contar el número total de pinturas con `mostrar = 1`
    $countQuery = "SELECT COUNT(*) AS total FROM Productos p 
                   INNER JOIN Pinturas pt ON p.id_producto = pt.id_producto 
                   WHERE p.mostrar = 1";
    $countResult = $conn->query($countQuery);
    $totalRows = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $paintingsPerPage);  // Calcular el número total de páginas

    // Mostrar enlaces de paginación con el número de página actual
    echo '<div class="pagination">';
    echo '<span>Página ' . $page . ' de ' . $totalPages . '</span><br>';

    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '">Anterior</a>';
    }
    if ($page < $totalPages) {
        echo '<a href="?page=' . ($page + 1) . '">Siguiente</a>';
    }
    echo '</div>';
} else {
    echo "No se encontraron pinturas.";
}

// Cierra la sentencia y la conexión
$stmt->close();
$conn->close();
