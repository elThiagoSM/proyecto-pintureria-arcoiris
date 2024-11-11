<?php
include '../../database/database.php'; // Conexión a la base de datos

header('Content-Type: application/json');

// Query para obtener las fechas, clasificaciones y contar los usuarios por fecha y clasificación
$sql = "SELECT DATE(fecha_ingreso) AS fecha, clasificacion, COUNT(id_usuario) AS conteo 
        FROM usuarios 
        GROUP BY DATE(fecha_ingreso), clasificacion 
        ORDER BY fecha";
$result = $conn->query($sql);

$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fecha = $row['fecha'];
        $clasificacion = $row['clasificacion'];
        $conteo = (int)$row['conteo'];

        // Agrupar datos por fecha si la fecha ya existe, o crearla si no existe
        if (!isset($usuarios[$fecha])) {
            $usuarios[$fecha] = ['Cliente' => 0, 'Administrador' => 0];
        }

        // Asignar el conteo a la clasificación correspondiente
        $usuarios[$fecha][$clasificacion] = $conteo;
    }
}

// Convertir a un arreglo simple para enviar en JSON
$data = [];
foreach ($usuarios as $fecha => $conteos) {
    $data[] = [
        'fecha' => $fecha,
        'cliente' => $conteos['Cliente'],
        'administrador' => $conteos['Administrador']
    ];
}

// Cerrar la conexión
$conn->close();

// Enviar datos en formato JSON
echo json_encode($data);
