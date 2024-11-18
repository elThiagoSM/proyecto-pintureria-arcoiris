<?php
include './database/database.php';

if (isset($_GET['id_producto'])) {
    $id_producto = $_GET['id_producto'];
    $query = "SELECT p.imagen, p.nombre, p.descripcion, p.precio, p.stock_cantidad, p.marca, p.fecha_ingreso, 
                     pr.nombre AS proveedor_nombre,
                     pt.litros, pt.funcion_aplicacion, pt.terminacion, pc.nombre_color
              FROM productos p
              LEFT JOIN proveedores pr ON p.id_proveedor = pr.id_proveedor
              LEFT JOIN pinturas pt ON p.id_producto = pt.id_producto
              LEFT JOIN paletacolor pc ON pt.id_paleta = pc.id_paleta
              WHERE p.id_producto = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        $producto = null;
    }
    $stmt->close();
} else {
    $producto = null;
}

$conn->close();
