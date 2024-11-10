<?php include 'auth.php'; ?>

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
                        <input type="radio" name="payment" value="transferencia" checked>
                        Transferencia
                    </label><br>
                    <label>
                        <input type="radio" name="payment" value="efectivo">
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
                    <input type='text' name='nombre' value='<?php echo $_SESSION['nombre_cliente']; ?>' placeholder='Nombre y apellido' disabled><br>
                    <input type='email' name='correo' value='<?php echo $_SESSION['correo']; ?>' placeholder='Dirección de email' disabled><br>
                    <input type='tel' name='telefono' value='<?php echo $_SESSION['datos_contacto']; ?>' placeholder='Número de teléfono' disabled><br>
                    <input type='text' name='cedula' value='<?php echo $_SESSION['cedula']; ?>' placeholder='Número de cedula' disabled>
                </fieldset>

                <fieldset>
                    <legend>Dejanos un mensaje</legend>
                    <input type="text" name="mensaje" placeholder="Mensaje"><br>
                </fieldset>

                <p>Producto: <?php echo isset($_GET['nombre_producto']) ? htmlspecialchars($_GET['nombre_producto']) : 'N/A'; ?></p>
                <p>Monto total: $<?php echo isset($_GET['monto_total']) ? htmlspecialchars($_GET['monto_total']) : 'N/A'; ?></p>
                <p>ID Producto: <?php echo isset($_GET['id_producto']) ? htmlspecialchars($_GET['id_producto']) : 'N/A'; ?></p>
                <p>Cantidad: <?php echo isset($_GET['cantidad']) ? htmlspecialchars($_GET['cantidad']) : 'N/A'; ?></p>

                <!-- Campos ocultos para pasar los datos por POST -->
                <input type="hidden" name="id_producto" value="<?php echo isset($_GET['id_producto']) ? (int)$_GET['id_producto'] : ''; ?>">
                <input type="hidden" name="monto_total" value="<?php echo isset($_GET['monto_total']) ? (float)$_GET['monto_total'] : ''; ?>">
                <input type="hidden" name="cantidad" value="<?php echo isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : ''; ?>">

                <button type="submit" class="btn-pago">Procesar Pago</button>
            </form>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>