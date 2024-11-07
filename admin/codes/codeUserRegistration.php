<?php
include '../database/database.php';

header('Content-Type: application/json');

// Query para obtener las fechas de ingreso y contar los usuarios por fecha
$sql = "SELECT DATE(fecha_ingreso) AS fecha, COUNT(id_usuario) AS conteo 
        FROM Usuarios 
        GROUP BY DATE(fecha_ingreso) 
        ORDER BY fecha";
$result = $conn->query($sql);

$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = [
            'fecha' => $row['fecha'],
            'conteo' => (int)$row['conteo']
        ];
    }
}

// Cerrar la conexión
$conn->close();

// Enviar datos en formato JSON
echo json_encode($usuarios);
