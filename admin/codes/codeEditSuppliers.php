<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_proveedor = $_POST['id_proveedor'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];

    $query = "UPDATE proveedores SET nombre = ?, telefono = ?, correo = ?, direccion = ? WHERE id_proveedor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nombre, $telefono, $correo, $direccion, $id_proveedor);

    if ($stmt->execute()) {
        header("Location: ../suppliers.php?mensaje=editado");
        exit();
    } else {
        echo "Error al actualizar el proveedor";
    }
}
