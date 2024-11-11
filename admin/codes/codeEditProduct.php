<?php
include '../database/database.php';

// Datos generales
$id_producto = $_POST['id_producto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock_cantidad = $_POST['stock_cantidad'];
$marca = $_POST['marca'];
$unidad = $_POST['unidad'];
$id_proveedor = $_POST['id_proveedor'];
$tipo_producto = $_POST['tipo_producto'];
$imagen = $_FILES['imagen']['name'] ? './assets/imgs/productos/' . $_FILES['imagen']['name'] : null;
$mostrar = isset($_POST['mostrar']) ? 1 : 0;

if ($imagen) {
    move_uploaded_file($_FILES['imagen']['tmp_name'], '../assets/imgs/productos/' . $_FILES['imagen']['name']);
}

// Actualizar datos generales del producto incluyendo 'mostrar'
$query = "UPDATE Productos SET nombre = ?, descripcion = ?, precio = ?, stock_cantidad = ?, marca = ?, unidad = ?, id_proveedor = ?, imagen = IFNULL(?, imagen), mostrar = ? WHERE id_producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdisisiii", $nombre, $descripcion, $precio, $stock_cantidad, $marca, $unidad, $id_proveedor, $imagen, $mostrar, $id_producto);
$stmt->execute();
$stmt->close();

// Actualizar datos específicos del producto
if ($tipo_producto == 'Pintura') {
    $litros = $_POST['litros'];
    $funcion_aplicacion = $_POST['funcion_aplicacion'];
    $terminacion = $_POST['terminacion'];
    $id_paleta = $_POST['id_paleta'];

    $query = "UPDATE Pinturas SET litros = ?, funcion_aplicacion = ?, terminacion = ?, id_paleta = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("dssii", $litros, $funcion_aplicacion, $terminacion, $id_paleta, $id_producto);
    $stmt->execute();
    $stmt->close();
} elseif ($tipo_producto == 'Accesorio') {
    $medidas = $_POST['medidas'];
    $tipo = $_POST['tipo'];

    $query = "UPDATE Accesorios SET medidas = ?, tipo = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $medidas, $tipo, $id_producto);
    $stmt->execute();
    $stmt->close();
} elseif ($tipo_producto == 'MiniFerreteria') {
    $garantia = $_POST['garantia'];

    $query = "UPDATE MiniFerreteria SET garantia = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $garantia, $id_producto);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

echo "<script>
    alert('Los cambios fueron guardados correctamente.');
    window.location.href = '../products.php';
</script>";
exit();
