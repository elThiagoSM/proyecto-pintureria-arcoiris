<?php
include './database/database.php';

// Configuracion de paginación
$accessoriesPerPage = 10;  // Numero de accesorios por pagina
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Pagina actual, por defecto es 1
$offset = ($page - 1) * $accessoriesPerPage;  // Calcular el desplazamiento

// Consulta con LIMIT y OFFSET para la paginacion, y filtrado por mostrar = 1
$query = "SELECT p.id_producto, p.imagen, p.nombre, p.descripcion, p.precio 
          FROM productos p
          INNER JOIN accesorios a ON p.id_producto = a.id_producto
          WHERE p.mostrar = 1
          LIMIT ? OFFSET ?";

// Prepara la consulta
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $accessoriesPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<div class="gallery">';

    // Mostrar los accesorios en la pagina actual
    while ($row = $result->fetch_assoc()) {
        echo '<a href="buyProduct.php?id_producto=' . $row['id_producto'] . '" class="accessory-type-link">';
        echo '<div class="accessory">';
        echo '<img src="' . $row['imagen'] . '" alt="' . $row['descripcion'] . '">';
        echo '<p class="product-name">' . $row['nombre'] . '</p>';
        echo '<p class="product-description">' . $row['descripcion'] . '</p>';
        echo '<p class="product-price">$' . $row['precio'] . '</p>';
        echo '</div>';
        echo '</a>';
    }

    echo '</div>';

    // Consulta para contar el nmero total de accesorios con mostrar = 1
    $countQuery = "SELECT COUNT(*) AS total FROM productos p 
                   INNER JOIN accesorios a ON p.id_producto = a.id_producto 
                   WHERE p.mostrar = 1";
    $countResult = $conn->query($countQuery);
    $totalRows = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $accessoriesPerPage);  // Calcular el nmero total de paginas

    // Mostrar enlaces de paginacion con el numero de pagina actual
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
    echo "No se encontraron accesorios.";
}

// Cierra la sentencia y la conexion
$stmt->close();
$conn->close();
