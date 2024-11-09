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
$cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1; // Recoge la cantidad (por defecto 1 si no se especifica)

// Obtener el id_usuario de la cookie
$id_usuario = isset($_COOKIE['id_usuario']) ? (int)$_COOKIE['id_usuario'] : null;

// Validar datos requeridos
if ($forma_pago && $id_producto && $valor_venta && $id_usuario && $cantidad) {
    // Iniciar una transacción para asegurar que ambas consultas se realicen juntas
    $conn->begin_transaction();

    try {
        // Insertar la venta en la tabla Ventas con el estado "en proceso" y la cantidad
        $stmt = $conn->prepare("INSERT INTO Ventas (forma_de_pago, fecha_de_venta, valor_de_venta, estado, datos_extra_notas, id_usuario, id_producto, cantidad) VALUES (?, ?, ?, 'en proceso', ?, ?, ?, ?)");
        $stmt->bind_param("ssdssii", $forma_pago, $fecha_venta, $valor_venta, $mensaje, $id_usuario, $id_producto, $cantidad);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar la venta: " . $stmt->error);
        }

        // Actualizar el stock del producto
        $stmt = $conn->prepare("UPDATE Productos SET stock_cantidad = stock_cantidad - ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $cantidad, $id_producto);

        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el stock: " . $stmt->error);
        }

        // Confirmar la transacción
        $conn->commit();

        echo "Venta registrada exitosamente.";
        header("Location: ../thanks.php"); // Redirigir a la página de agradecimiento
        exit();
    } catch (Exception $e) {
        // Si hay un error, revertir la transacción
        $conn->rollback();
        echo $e->getMessage();
    }

    $stmt->close();
} else {
    echo "Faltan datos necesarios para realizar la venta.";
}

$conn->close();
