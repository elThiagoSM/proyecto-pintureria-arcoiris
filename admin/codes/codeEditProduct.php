<?php
include '../database/database.php';

$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock_cantidad = $_POST['stock_cantidad'];
$marca = $_POST['marca'];
$unidad = $_POST['unidad'];
$id_proveedor = $_POST['id_proveedor'];
$imagen = $_FILES['imagen']['name'] ? './assets/imgs/productos/' . $_FILES['imagen']['name'] : null;

if ($imagen) {
    move_uploaded_file($_FILES['imagen']['tmp_name'], '../assets/imgs/productos/' . $_FILES['imagen']['name']);
}

// Actualizar datos del producto
$query = "UPDATE Productos SET nombre = ?, descripcion = ?, precio = ?, stock_cantidad = ?, marca = ?, unidad = ?, id_proveedor = ?, imagen = IFNULL(?, imagen) WHERE id_producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdisisii", $nombre, $descripcion, $precio, $stock_cantidad, $marca, $unidad, $id_proveedor, $imagen, $id_producto);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar el producto o no hubo cambios.";
}

$stmt->close();
$conn->close();

header("Location: ../products.php");
exit();
