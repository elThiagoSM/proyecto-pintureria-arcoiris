<?php
include '../database/database.php'; // Conexión a la base de datos

// Recoge datos del formulario
$forma_pago = isset($_POST['payment']) ? $_POST['payment'] : null;
$forma_pago = ($forma_pago == "mercado_pago") ? "transferencia" : "efectivo"; // Adaptamos los valores según la BD
$fecha_venta = date("Y-m-d");
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : "";

// Datos pasados en la URL
$id_producto = isset($_POST['id_producto']) ? (int)$_POST['id_producto'] : null;
$valor_venta = isset($_POST['monto_total']) ? (float)$_POST['monto_total'] : null;

// Obtener el id_usuario de la cookie
$id_usuario = isset($_COOKIE['id_usuario']) ? (int)$_COOKIE['id_usuario'] : null;

// Agregar mensajes de depuración
echo "Forma de Pago: " . ($forma_pago ?: 'Nulo') . "<br>";
echo "Fecha Venta: " . ($fecha_venta ?: 'Nulo') . "<br>";
echo "Mensaje: " . ($mensaje ?: 'Nulo') . "<br>";
echo "ID Producto: " . ($id_producto ?: 'Nulo') . "<br>";
echo "Valor Venta: " . ($valor_venta ?: 'Nulo') . "<br>";
echo "ID Usuario: " . ($id_usuario ?: 'Nulo') . "<br>";

// Validar datos requeridos
if ($forma_pago && $id_producto && $valor_venta && $id_usuario) {
    // Preparar la consulta SQL con el estado "en proceso" por defecto
    $stmt = $conn->prepare("INSERT INTO Ventas (forma_de_pago, fecha_de_venta, valor_de_venta, estado, datos_extra_notas, id_usuario, id_producto) VALUES (?, ?, ?, 'en proceso', ?, ?, ?)");
    $stmt->bind_param("ssdssi", $forma_pago, $fecha_venta, $valor_venta, $mensaje, $id_usuario, $id_producto);

    // Ejecutar y verificar la inserción
    if ($stmt->execute()) {
        echo "Venta registrada exitosamente.";
        header("Location: ../thanks.php"); // Redirigir a la página de agradecimiento
        exit();
    } else {
        echo "Error al registrar la venta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos necesarios para realizar la venta.";
}

$conn->close();
