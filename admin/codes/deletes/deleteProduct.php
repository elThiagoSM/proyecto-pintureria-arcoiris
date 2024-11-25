<?php
include './database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Decodifica el cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $idProducto = isset($data['id_producto']) ? (int)$data['id_producto'] : 0;

    if ($idProducto <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID de producto no válido.']);
        exit();
    }

    // Verificar si el producto esta relacionado con otras tablas
    $queryCheck = "SELECT COUNT(*) AS total FROM ventas WHERE id_producto = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bind_param('i', $idProducto);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $totalVentas = $resultCheck->fetch_assoc()['total'];

    if ($totalVentas > 0) {
        echo json_encode(['success' => false, 'message' => 'No se puede eliminar este producto porque está relacionado con ventas.']);
        exit();
    }

    // Eliminar el producto
    $queryDelete = "DELETE FROM productos WHERE id_producto = ?";
    $stmtDelete = $conn->prepare($queryDelete);
    $stmtDelete->bind_param('i', $idProducto);

    if ($stmtDelete->execute()) {
        echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el producto.']);
    }
}
