<?php
// codeProcessSales.php

include '../database/database.php';

// Verificar que el usuario tiene permisos de administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    header("Location: loginAdmin.php");
    exit();
}

// Validar los parámetros de la solicitud
$action = $_GET['action'] ?? null;
$id_venta = $_GET['id_venta'] ?? null;

if (!$action || !$id_venta) {
    echo "Acción o ID de venta no especificado.";
    exit();
}

if ($action === 'confirm') {
    // Lógica para completar la venta
    $stmt = $conn->prepare("UPDATE Ventas SET estado = 'completado' WHERE id_venta = ?");
    $stmt->bind_param("i", $id_venta);
    if ($stmt->execute()) {
        echo "Venta completada con éxito.";
    } else {
        echo "Error al completar la venta: " . $stmt->error;
    }
    $stmt->close();
} elseif ($action === 'cancel') {
    // Obtener la cantidad de productos y el ID del producto para actualizar el stock
    $stmt = $conn->prepare("SELECT id_producto, cantidad FROM Ventas WHERE id_venta = ?");
    $stmt->bind_param("i", $id_venta);
    $stmt->execute();
    $stmt->bind_result($id_producto, $cantidad);
    $stmt->fetch();
    $stmt->close();

    if ($id_producto && $cantidad) {
        // Actualizar el stock del producto
        $stmt = $conn->prepare("UPDATE Productos SET stock_cantidad = stock_cantidad + ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $cantidad, $id_producto);
        if ($stmt->execute()) {
            // Eliminar la venta después de actualizar el stock
            $stmt = $conn->prepare("DELETE FROM Ventas WHERE id_venta = ?");
            $stmt->bind_param("i", $id_venta);
            if ($stmt->execute()) {
                echo "Venta cancelada y eliminada con éxito. Stock actualizado.";
            } else {
                echo "Error al cancelar la venta: " . $stmt->error;
            }
        } else {
            echo "Error al actualizar el stock: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al obtener los detalles de la venta.";
    }
} else {
    echo "Acción no válida.";
}

$conn->close();
header("Location: ../processSales.php");
exit();
