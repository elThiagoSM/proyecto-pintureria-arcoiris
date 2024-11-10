<?php
session_start();

// Verificar si la sesión del usuario está configurada
if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombre_usuario']) && isset($_SESSION['correo']) && isset($_SESSION['clasificacion'])) {
    // Obtener los valores desde la sesión
    $id_usuario = $_SESSION['id_usuario'];
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $correo = $_SESSION['correo'];
    $clasificacion = $_SESSION['clasificacion'];
    $direccion = isset($_SESSION['direccion']) ? $_SESSION['direccion'] : '';
    $datos_contacto = isset($_SESSION['datos_contacto']) ? $_SESSION['datos_contacto'] : '';
    $fecha_nacimiento = isset($_SESSION['fecha_nacimiento']) ? $_SESSION['fecha_nacimiento'] : '';
    $cedula = isset($_SESSION['cedula']) ? $_SESSION['cedula'] : '';
    $foto_perfil = isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : '';
} else {
    // Si no hay sesión activa, redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar compra</title>
    <link rel="stylesheet" href="./css/checkoutStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="checkout">
        <div class="checkout-container">
            <h1>CONFIRMAR DATOS COMPRA</h1>

            <form action="./codes/codeCheckout.php" method="POST">
                <fieldset>
                    <legend>Forma de pago</legend>
                    <label>
                        <input type="radio" name="payment" value="mercado_pago" checked>
                        Transferencia
                    </label><br>
                    <label>
                        <input type="radio" name="payment" value="transferencia_bancaria">
                        Efectivo
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Forma de envío</legend>
                    <label>
                        <input type="radio" name="shipping" value="local" checked>
                        Retira en local
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Tus datos</legend>
                    <?php include './codes/checkoutData.php'; ?>
                </fieldset>

                <fieldset>
                    <legend>Dejanos un mensaje</legend>
                    <input type="text" name="mensaje" placeholder="Mensaje"><br>
                </fieldset>

                <p>Producto: <?php echo isset($_GET['nombre_producto']) ? htmlspecialchars($_GET['nombre_producto']) : 'N/A'; ?></p>
                <p>Monto total: $<?php echo isset($_GET['monto_total']) ? htmlspecialchars($_GET['monto_total']) : 'N/A'; ?></p>
                <p>ID Producto: <?php echo isset($_GET['id_producto']) ? htmlspecialchars($_GET['id_producto']) : 'N/A'; ?></p>
                <p>Cantidad: <?php echo isset($_GET['cantidad']) ? htmlspecialchars($_GET['cantidad']) : 'N/A'; ?></p> <!-- Mostrar la cantidad -->

                <!-- Campos ocultos para pasar los datos por POST -->
                <input type="hidden" name="id_producto" value="<?php echo isset($_GET['id_producto']) ? (int)$_GET['id_producto'] : ''; ?>">
                <input type="hidden" name="monto_total" value="<?php echo isset($_GET['monto_total']) ? (float)$_GET['monto_total'] : ''; ?>">
                <input type="hidden" name="cantidad" value="<?php echo isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : ''; ?>"> <!-- Nuevo campo para cantidad -->


                <button type="submit" class="btn-pago">Procesar Pago</button>
            </form>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>