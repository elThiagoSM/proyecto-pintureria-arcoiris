<?php
session_start();
include '../database/database.php';

// Recoge datos del formulario
$forma_pago = isset($_POST['payment']) ? $_POST['payment'] : null;
$fecha_venta = date("Y-m-d");
$mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : "";

// Datos pasados en el formulario
$id_producto = isset($_POST['id_producto']) ? (int)$_POST['id_producto'] : null;
$valor_venta = isset($_POST['monto_total']) ? (float)$_POST['monto_total'] : null;
$cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 1;

// Datos del cliente en sesión
$id_cliente = isset($_SESSION['id_cliente']) ? (int)$_SESSION['id_cliente'] : null;
$nombre_cliente = isset($_SESSION['nombre_cliente']) ? $_SESSION['nombre_cliente'] : "Cliente";
$correo_cliente = isset($_SESSION['correo']) ? $_SESSION['correo'] : null;

if ($forma_pago && $id_producto && $valor_venta && $id_cliente && $cantidad) {
    $conn->begin_transaction();

    try {
        // Insertar la venta en la tabla Ventas
        $stmt = $conn->prepare("INSERT INTO ventas (forma_de_pago, fecha_de_venta, valor_de_venta, estado, datos_extra_notas, id_cliente, id_producto, cantidad) VALUES (?, ?, ?, 'en proceso', ?, ?, ?, ?)");
        $stmt->bind_param("ssdssii", $forma_pago, $fecha_venta, $valor_venta, $mensaje, $id_cliente, $id_producto, $cantidad);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar la venta: " . $stmt->error);
        }

        // Obtener el ID de la venta recién insertada
        $id_venta = $conn->insert_id;

        // Actualizar el stock del producto
        $stmt = $conn->prepare("UPDATE productos SET stock_cantidad = stock_cantidad - ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $cantidad, $id_producto);

        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar el stock: " . $stmt->error);
        }

        $conn->commit();

        // Configurar detalles del correo
        if ($correo_cliente) {
            $asunto = "Detalles de tu compra - Pinturería Arcoiris";
            $mensaje_html = "
            <html>
            <head>
                <title>Detalles de tu Compra</title>
                <style>
                    body { font-family: Arial, sans-serif; color: #333; }
                    .container { width: 80%; margin: 0 auto; }
                    h2 { color: #28a745; }
                    .details { background-color: #f9f9f9; padding: 15px; border-radius: 8px; }
                    .details p { line-height: 1.6; }
                    .details .highlight { font-weight: bold; color: #28a745; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h2>¡Gracias por tu compra, $nombre_cliente!</h2>
                    <p>A continuación te enviamos los detalles de tu compra en Pinturería Arcoiris:</p>
                    <div class='details'>
                        <p><span class='highlight'>Nro. de Pedido:</span> $id_venta</p>
                        <p><span class='highlight'>Producto:</span> {$_GET['nombre_producto']}</p>
                        <p><span class='highlight'>Cantidad:</span> $cantidad</p>
                        <p><span class='highlight'>Monto Total:</span> $" . number_format($valor_venta, 2) . "</p>
                        <p><span class='highlight'>Forma de Pago:</span> $forma_pago</p>
                        <p><span class='highlight'>Forma de Envio:</span> Retira en local</p>
                        <p><span class='highlight'>Fecha de Compra:</span> $fecha_venta</p>
                    </div>
                    <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
                    <p style='font-size: 12px; color: #999;'>Pinturería Arcoiris &copy; " . date("Y") . "</p>
                </div>
            </body>
            </html>";

            // Encabezados del correo
            $cabeceras = "From: no-reply@tu_sitio.com\r\n";
            $cabeceras .= "Reply-To: no-reply@tu_sitio.com\r\n";
            $cabeceras .= "MIME-Version: 1.0\r\n";
            $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

            if (!mail($correo_cliente, $asunto, $mensaje_html, $cabeceras)) {
                $_SESSION['error'] = "La compra fue exitosa, pero no se pudo enviar el correo de confirmación.";
            }
        }

        // Redirigir a thanks.php con mensaje de éxito
        $_SESSION['success'] = "Compra realizada con éxito. Gracias por tu compra.";
        header("Location: ../thanks.php?nombre_cliente=" . urlencode($nombre_cliente) . "&id_venta=" . $id_venta . "&total=" . $valor_venta);
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../checkout.php");
        exit();
    }

    $stmt->close();
} else {
    $_SESSION['error'] = "Faltan datos necesarios para realizar la venta.";
    header("Location: ../checkout.php");
}

$conn->close();
