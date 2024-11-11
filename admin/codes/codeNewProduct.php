<?php
include '../database/database.php';

$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = floatval($_POST['precio']);
$stock_cantidad = intval($_POST['stock_cantidad']);
$marca = $conn->real_escape_string($_POST['marca']);
$unidad = $conn->real_escape_string($_POST['unidad']);
$id_proveedor = intval($_POST['id_proveedor']);
$tipo_producto = $_POST['tipo_producto'];
$mostrar = isset($_POST['mostrar']) ? 1 : 0;  // Capturamos el valor del checkbox

$imagen = './assets/imgs/productos/none.png';
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $rutaImagen = './uploads/' . basename($_FILES['imagen']['name']);
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        $imagen = $rutaImagen;
    }
}

// Inserción en la tabla Productos con el campo mostrar
$sql_producto = "INSERT INTO Productos (imagen, nombre, descripcion, precio, stock_cantidad, marca, unidad, fecha_ingreso, id_proveedor, mostrar)
                 VALUES ('$imagen', '$nombre', '$descripcion', $precio, $stock_cantidad, '$marca', '$unidad', CURDATE(), $id_proveedor, $mostrar)";

if ($conn->query($sql_producto) === TRUE) {
    $id_producto = $conn->insert_id;

    // Inserciones específicas por tipo de producto
    if ($tipo_producto === 'Accesorio') {
        $medidas = $conn->real_escape_string($_POST['medidas']);
        $tipo = $conn->real_escape_string($_POST['tipo']);
        $sql_accesorio = "INSERT INTO Accesorios (id_producto, medidas, tipo) VALUES ($id_producto, '$medidas', '$tipo')";
        if (!$conn->query($sql_accesorio)) {
            echo "<script>alert('Error al insertar accesorio: " . $conn->error . "');window.location.href = '../products.php';</script>";
            exit();
        }
    } elseif ($tipo_producto === 'MiniFerreteria') {
        $garantia = $conn->real_escape_string($_POST['garantia']);
        $sql_mini_ferreteria = "INSERT INTO MiniFerreteria (id_producto, garantia) VALUES ($id_producto, '$garantia')";
        if (!$conn->query($sql_mini_ferreteria)) {
            echo "<script>alert('Error al insertar mini ferretería: " . $conn->error . "');window.location.href = '../products.php';</script>";
            exit();
        }
    } elseif ($tipo_producto === 'Pintura') {
        $litros = floatval($_POST['litros']);
        $funcion_aplicacion = $conn->real_escape_string($_POST['funcion_aplicacion']);
        $id_paleta = intval($_POST['id_paleta']);
        $terminacion = $conn->real_escape_string($_POST['terminacion']);
        $sql_pintura = "INSERT INTO Pinturas (id_producto, litros, funcion_aplicacion, id_paleta, terminacion) VALUES ($id_producto, $litros, '$funcion_aplicacion', $id_paleta, '$terminacion')";
        if (!$conn->query($sql_pintura)) {
            echo "<script>alert('Error al insertar pintura: " . $conn->error . "');window.location.href = '../products.php';</script>";
            exit();
        }
    }

    echo "<script>alert('Producto agregado exitosamente.');window.location.href = '../products.php';</script>";
} else {
    echo "<script>alert('Error al insertar producto: " . $conn->error . "');window.location.href = '../products.php';</script>";
}

$conn->close();
