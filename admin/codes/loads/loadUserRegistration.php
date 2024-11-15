<?php
include '../../database/database.php'; // Conexión a la base de datos


header('Content-Type: application/json');

$sql = "SELECT DATE(fecha_ingreso) AS fecha, clasificacion, COUNT(id_usuario) AS conteo 
        FROM usuarios 
        GROUP BY DATE(fecha_ingreso), clasificacion 
        ORDER BY fecha";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
    exit();
}

$usuarios = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fecha = $row['fecha'];
        $clasificacion = $row['clasificacion'];
        $conteo = (int)$row['conteo'];

        if (!isset($usuarios[$fecha])) {
            $usuarios[$fecha] = ['Cliente' => 0, 'Administrador' => 0];
        }

        $usuarios[$fecha][$clasificacion] = $conteo;
    }
}

$data = [];
foreach ($usuarios as $fecha => $conteos) {
    $data[] = [
        'fecha' => $fecha,
        'cliente' => $conteos['Cliente'],
        'administrador' => $conteos['Administrador']
    ];
}

$conn->close();

echo json_encode($data, JSON_PRETTY_PRINT);
