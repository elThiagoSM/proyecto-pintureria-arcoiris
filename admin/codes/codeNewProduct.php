<?php
include '../database/database.php'; // Conexión a la base de datos

// Obtener y validar los datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$precio = floatval($_POST['precio']);
$stock_cantidad = intval($_POST['stock_cantidad']);
$marca = $conn->real_escape_string($_POST['marca']);
$unidad = $conn->real_escape_string($_POST['unidad']);
$id_proveedor = intval($_POST['id_proveedor']);
$tipo_producto = $_POST['tipo_producto'];

// Manejar la subida de la imagen
$imagen = './assets/imgs/productos/none.png'; // Imagen por defecto
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $rutaImagen = './uploads/' . basename($_FILES['imagen']['name']);
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        $imagen = $rutaImagen;
    }
}

// Insertar datos en la tabla Productos
$sql_producto = "INSERT INTO Productos (imagen, nombre, descripcion, precio, stock_cantidad, marca, unidad, fecha_ingreso, id_proveedor)
                 VALUES ('$imagen', '$nombre', '$descripcion', $precio, $stock_cantidad, '$marca', '$unidad', CURDATE(), $id_proveedor)";

if ($conn->query($sql_producto) === TRUE) {
    $id_producto = $conn->insert_id; // Obtener el ID del producto insertado

    // Insertar en la tabla específica según el tipo de producto
    if ($tipo_producto === 'Accesorio') {
        $medidas = $conn->real_escape_string($_POST['medidas']);
        $tipo = $conn->real_escape_string($_POST['tipo']);
        $sql_accesorio = "INSERT INTO Accesorios (id_producto, medidas, tipo) VALUES ($id_producto, '$medidas', '$tipo')";
        if (!$conn->query($sql_accesorio)) {
            echo "Error al insertar accesorio: " . $conn->error;
        }
    } elseif ($tipo_producto === 'MiniFerreteria') {
        $garantia = $conn->real_escape_string($_POST['garantia']);
        $sql_mini_ferreteria = "INSERT INTO MiniFerreteria (id_producto, garantia) VALUES ($id_producto, '$garantia')";
        if (!$conn->query($sql_mini_ferreteria)) {
            echo "Error al insertar mini ferretería: " . $conn->error;
        }
    } elseif ($tipo_producto === 'Pintura') {
        $litros = floatval($_POST['litros']);
        $funcion_aplicacion = $conn->real_escape_string($_POST['funcion_aplicacion']);
        $id_paleta = intval($_POST['id_paleta']);
        $terminacion = $conn->real_escape_string($_POST['terminacion']);
        $sql_pintura = "INSERT INTO Pinturas (id_producto, litros, funcion_aplicacion, id_paleta, terminacion)
                        VALUES ($id_producto, $litros, '$funcion_aplicacion', $id_paleta, '$terminacion')";
        if (!$conn->query($sql_pintura)) {
            echo "Error al insertar pintura: " . $conn->error;
        }
    }

    echo "Producto agregado exitosamente.";
} else {
    echo "Error al insertar producto: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
