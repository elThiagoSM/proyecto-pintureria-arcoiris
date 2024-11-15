<?php
include '../database/database.php';

// Validar y obtener datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = floatval($_POST['precio']);
$stock_cantidad = intval($_POST['stock_cantidad']);
$marca = $conn->real_escape_string($_POST['marca']);
$unidad = $conn->real_escape_string($_POST['unidad']);
$id_proveedor = intval($_POST['id_proveedor']);
$tipo_producto = $_POST['tipo_producto'];
$mostrar = isset($_POST['mostrar']) ? 1 : 0; // Checkbox de visibilidad

// Ruta por defecto para la imagen
$imagen = './assets/imgs/productos/none.png';

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    // Definir ruta fija del proyecto y la carpeta de carga de imágenes
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
            header("Location: ../newProduct.php?upload=error_type");
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

// Inserción en la tabla Productos
$sql_producto = "INSERT INTO Productos (imagen, nombre, descripcion, precio, stock_cantidad, marca, unidad, fecha_ingreso, id_proveedor, mostrar)
                 VALUES ('$imagen', '$nombre', '$descripcion', $precio, $stock_cantidad, '$marca', '$unidad', CURDATE(), $id_proveedor, $mostrar)";

if ($conn->query($sql_producto) === TRUE) {
    $id_producto = $conn->insert_id;

    // Inserción según tipo de producto
    if ($tipo_producto === 'Accesorio') {
        $medidas = $conn->real_escape_string($_POST['medidas']);
        $tipo = $conn->real_escape_string($_POST['tipo']);
        $sql_accesorio = "INSERT INTO Accesorios (id_producto, medidas, tipo) VALUES ($id_producto, '$medidas', '$tipo')";
        if (!$conn->query($sql_accesorio)) {
            echo "<script>alert('Error al insertar accesorio: " . $conn->error . "'); window.location.href = '../products.php';</script>";
            exit();
        }
    } elseif ($tipo_producto === 'MiniFerreteria') {
        $garantia = $conn->real_escape_string($_POST['garantia']);
        $sql_mini_ferreteria = "INSERT INTO MiniFerreteria (id_producto, garantia) VALUES ($id_producto, '$garantia')";
        if (!$conn->query($sql_mini_ferreteria)) {
            echo "<script>alert('Error al insertar mini ferretería: " . $conn->error . "'); window.location.href = '../products.php';</script>";
            exit();
        }
    } elseif ($tipo_producto === 'Pintura') {
        $litros = floatval($_POST['litros']);
        $funcion_aplicacion = $conn->real_escape_string($_POST['funcion_aplicacion']);
        $id_paleta = intval($_POST['id_paleta']);
        $terminacion = $conn->real_escape_string($_POST['terminacion']);
        $sql_pintura = "INSERT INTO Pinturas (id_producto, litros, funcion_aplicacion, id_paleta, terminacion) VALUES ($id_producto, $litros, '$funcion_aplicacion', $id_paleta, '$terminacion')";
        if (!$conn->query($sql_pintura)) {
            echo "<script>alert('Error al insertar pintura: " . $conn->error . "'); window.location.href = '../products.php';</script>";
            exit();
        }
    }

    echo "<script>alert('Producto agregado exitosamente.'); window.location.href = '../products.php';</script>";
} else {
    echo "<script>alert('Error al insertar producto: " . $conn->error . "'); window.location.href = '../products.php';</script>";
}

$conn->close();
