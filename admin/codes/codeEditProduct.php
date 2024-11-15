<?php
include '../database/database.php';

// Datos generales del producto
$id_producto = $_POST['id_producto'];
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = floatval($_POST['precio']);
$stock_cantidad = intval($_POST['stock_cantidad']);
$marca = $conn->real_escape_string($_POST['marca']);
$unidad = $conn->real_escape_string($_POST['unidad']);
$id_proveedor = intval($_POST['id_proveedor']);
$tipo_producto = $_POST['tipo_producto'];
$mostrar = isset($_POST['mostrar']) ? 1 : 0;

// Manejo de la subida de imagen
$imagen = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    // Definir ruta base del proyecto
    $projectPath = '/proyecto-pintureria-arcoiris';
    $uploadsDir = $_SERVER['DOCUMENT_ROOT'] . $projectPath . '/uploads/product_images/';

    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0755, true);
    }

    $fileTmpPath = $_FILES['imagen']['tmp_name'];
    list($width, $height, $imageType) = getimagesize($fileTmpPath);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $srcImage = imagecreatefromjpeg($fileTmpPath);
            break;
        case IMAGETYPE_PNG:
            $srcImage = imagecreatefrompng($fileTmpPath);
            break;
        default:
            header("Location: ../editProduct.php?id_producto=$id_producto&upload=error_type");
            exit();
    }

    $newWidth = min($width, 1100);
    $newHeight = min($height, 1200);

    $dstImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    $fileName = uniqid('producto_') . '.jpg';
    $destPath = $uploadsDir . $fileName;
    imagejpeg($dstImage, $destPath, 90);

    imagedestroy($srcImage);
    imagedestroy($dstImage);

    $imagen = $projectPath . '/uploads/product_images/' . $fileName;
}

// Actualizar los datos generales del producto
// Solo actualizar la imagen si se subió una nueva
if ($imagen) {
    $query = "UPDATE Productos SET nombre = ?, descripcion = ?, precio = ?, stock_cantidad = ?, marca = ?, unidad = ?, id_proveedor = ?, imagen = ?, mostrar = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdisissii", $nombre, $descripcion, $precio, $stock_cantidad, $marca, $unidad, $id_proveedor, $imagen, $mostrar, $id_producto);
} else {
    $query = "UPDATE Productos SET nombre = ?, descripcion = ?, precio = ?, stock_cantidad = ?, marca = ?, unidad = ?, id_proveedor = ?, mostrar = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdisisii", $nombre, $descripcion, $precio, $stock_cantidad, $marca, $unidad, $id_proveedor, $mostrar, $id_producto);
}

$stmt->execute();
$stmt->close();

// Actualizar los datos específicos según el tipo de producto
if ($tipo_producto == 'Pintura') {
    $litros = floatval($_POST['litros']);
    $funcion_aplicacion = $conn->real_escape_string($_POST['funcion_aplicacion']);
    $terminacion = $conn->real_escape_string($_POST['terminacion']);
    $id_paleta = intval($_POST['id_paleta']);

    $query = "UPDATE Pinturas SET litros = ?, funcion_aplicacion = ?, terminacion = ?, id_paleta = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("dssii", $litros, $funcion_aplicacion, $terminacion, $id_paleta, $id_producto);
    $stmt->execute();
    $stmt->close();
} elseif ($tipo_producto == 'Accesorio') {
    $medidas = $conn->real_escape_string($_POST['medidas']);
    $tipo = $conn->real_escape_string($_POST['tipo']);

    $query = "UPDATE Accesorios SET medidas = ?, tipo = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $medidas, $tipo, $id_producto);
    $stmt->execute();
    $stmt->close();
} elseif ($tipo_producto == 'MiniFerreteria') {
    $garantia = $conn->real_escape_string($_POST['garantia']);

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
