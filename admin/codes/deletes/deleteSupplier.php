<?php
include './database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Decodifica el cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $idProveedor = isset($data['id_proveedor']) ? (int)$data['id_proveedor'] : 0;

    if ($idProveedor <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID de proveedor no válido.']);
        exit();
    }

    // Verificar si el proveedor tiene productos asociados
    $queryCheck = "SELECT COUNT(*) AS total FROM productos WHERE id_proveedor = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bind_param('i', $idProveedor);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $totalProductos = $resultCheck->fetch_assoc()['total'];

    if ($totalProductos > 0) {
        echo json_encode(['success' => false, 'message' => 'No se puede eliminar este proveedor porque está relacionado con productos.']);
        exit();
    }

    // Eliminar el proveedor
    $queryDelete = "DELETE FROM proveedores WHERE id_proveedor = ?";
    $stmtDelete = $conn->prepare($queryDelete);
    $stmtDelete->bind_param('i', $idProveedor);

    if ($stmtDelete->execute()) {
        echo json_encode(['success' => true, 'message' => 'Proveedor eliminado exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el proveedor.']);
    }
}
