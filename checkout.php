<?php
// Verificar si las cookies estan configuradas, lo que indica que el usuario esta logueado
if (isset($_COOKIE['id_usuario']) && isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['correo']) && isset($_COOKIE['clasificacion'])) {
    // Obtener los valores desde las cookies
    $id_usuario = $_COOKIE['id_usuario'];
    $nombre_usuario = $_COOKIE['nombre_usuario'];
    $correo = $_COOKIE['correo'];
    $clasificacion = $_COOKIE['clasificacion'];
    $direccion = isset($_COOKIE['direccion']) ? $_COOKIE['direccion'] : '';
    $datos_contacto = isset($_COOKIE['datos_contacto']) ? $_COOKIE['datos_contacto'] : '';
    $fecha_nacimiento = isset($_COOKIE['fecha_nacimiento']) ? $_COOKIE['fecha_nacimiento'] : '';
    $cedula = isset($_COOKIE['cedula']) ? $_COOKIE['cedula'] : '';
    $cedula = isset($_COOKIE['foto_perfil']) ? $_COOKIE['foto_perfil'] : '';
} else {
    // Si no hay cookies, redirigir al login
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