<?php
include './database/database.php'; // Conexión a la base de datos
session_start();

// Consulta para obtener las herramientas con sus detalles
$query = "SELECT p.id_producto, p.imagen, p.descripción, p.precio 
          FROM Productos p
          INNER JOIN Mini_ferreteria mf ON p.id_producto = mf.id_producto";

// Prepara la consulta
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Abre el contenedor de la galería
    echo '<div class="gallery">';

    // Recorre cada herramienta y la muestra en la galería
    while ($row = $result->fetch_assoc()) {
        echo '<div class="tool">';
        echo '<img src="' . $row['imagen'] . '" alt="Imagen de la herramienta">';
        echo '<p class="product-description">' . $row['descripción'] . '</p>';
        echo '<p class="product-price"><strong>Precio: </strong>$' . $row['precio'] . '</p>';
        echo '</div>';
    }

    // Cierra el contenedor de la galería
    echo '</div>';
} else {
    echo "No se encontraron herramientas.";
}

// Cierra la sentencia y la conexión
$stmt->close();
$conn->close();
