<?php
include '../../database/database.php'; // Conexión a la base de datos

header('Content-Type: application/json');

// Query para obtener datos de ventas (fecha y valor de venta)
$sql = "SELECT fecha_de_venta, valor_de_venta FROM Ventas WHERE estado = 'completado' ORDER BY fecha_de_venta";
$result = $conn->query($sql);

$ventas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ventas[] = [
            'fecha' => $row['fecha_de_venta'],
            'valor' => (float)$row['valor_de_venta']
        ];
    }
}

// Cerrar la conexión
$conn->close();

// Enviar datos en formato JSON
echo json_encode($ventas);
