<?php
include './database/database.php';

// Limitar a 8 productos destacados
$query = "SELECT id_producto, imagen, nombre, descripcion, precio 
          FROM productos 
          WHERE mostrar = TRUE 
          ORDER BY fecha_ingreso DESC 
          LIMIT 8";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Mostrar los productos destacados con nombre, descripcion y precio
    while ($row = $result->fetch_assoc()) {
        echo '<a href="buyProduct.php?id_producto=' . htmlspecialchars($row['id_producto']) . '" class="featured-product-link">';
        echo '<div class="product">';
        echo '<img src="' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '" />';
        echo '<p class="product-name">' . htmlspecialchars($row['nombre']) . '</p>';
        echo '<p class="product-description">' . htmlspecialchars($row['descripcion']) . '</p>';
        echo '<p class="product-price">$' . number_format($row['precio'], 2) . '</p>';
        echo '</div>';
        echo '</a>';
    }
} else {
    echo "<p>No se encontraron productos destacados.</p>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
