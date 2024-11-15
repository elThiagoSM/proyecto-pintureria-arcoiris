<?php
include './database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Decodificar cuerpo de solicitud JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $idPaleta = isset($data['id_paleta']) ? (int)$data['id_paleta'] : 0;

    if ($idPaleta <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID de paleta no válido.']);
        exit();
    }

    // Verificar si la paleta está relacionada con pinturas
    $queryCheck = "SELECT COUNT(*) AS total FROM pinturas WHERE id_paleta = ?";
    $stmtCheck = $conn->prepare($queryCheck);
    $stmtCheck->bind_param('i', $idPaleta);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $totalPinturas = $resultCheck->fetch_assoc()['total'];

    if ($totalPinturas > 0) {
        echo json_encode(['success' => false, 'message' => 'No se puede eliminar esta paleta porque está relacionada con pinturas.']);
        exit();
    }

    // Eliminar la paleta de colores
    $queryDelete = "DELETE FROM paletacolor WHERE id_paleta = ?";
    $stmtDelete = $conn->prepare($queryDelete);
    $stmtDelete->bind_param('i', $idPaleta);

    if ($stmtDelete->execute()) {
        echo json_encode(['success' => true, 'message' => 'Paleta de colores eliminada exitosamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo eliminar la paleta de colores.']);
    }
}
