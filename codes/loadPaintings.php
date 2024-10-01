<?php
include './database/database.php'; // Conexion a la base de datos
session_start();

// Consulta para obtener las pinturas con sus detalles
$query = "SELECT p.id_producto, p.imagen, p.descripción, p.precio 
          FROM Productos p
          INNER JOIN Pinturas pt ON p.id_producto = pt.id_producto";

// Prepara la consulta
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Abre el contenedor de la galería
    echo '<div class="gallery">';

    // Recorre cada pintura y la muestra en la galeria
    while ($row = $result->fetch_assoc()) {
        echo '<div class="paint-type">';
        echo '<img src="' . $row['imagen'] . '" alt="Imagen de pintura">';
        echo '<p>' . $row['descripción'] . '</p>';
        echo '<p><strong>Precio: </strong>$' . $row['precio'] . '</p>';
        echo '</div>';
    }

    // Cierra el contenedor de la galeria
    echo '</div>';
} else {
    echo "No se encontraron pinturas.";
}

// Cierra la sentencia y la conexión
$stmt->close();
$conn->close();
