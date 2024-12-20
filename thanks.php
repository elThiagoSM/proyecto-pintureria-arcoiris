<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar compra</title>
    <link rel="stylesheet" href="./css/thanksStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="thanks">
        <div class="thanks-container">
            <h1>¡Muchas Gracias por tu Compra!</h1>
            <p>Te enviaremos un e-mail de confirmación con los detalles del pedido.</p>
            <p>
                Si eligio como metodo de pago transferencia, recuerda <strong>enviarnos el comprobante</strong> a
                <a href="mailto:pintureriaacoiris@gmail.com">pintureriaacoiris@gmail.com</a> para agilizar el despacho.
            </p>

            <p>Depósito o transferencia bancaria a la siguiente cuenta:</p>
            <div class="bank-details">
                <p>
                    <strong>Cuenta Corriente en pesos N°:</strong> 0783229537<br>
                    <strong>Banco:</strong> BROU<br>
                    <strong>Titular:</strong> Pinturería Arcoiris SRL<br>
                </p>
            </div>

            <div class="order-details">
                <div><strong>Nombre</strong> <span><?php echo htmlspecialchars($_GET['nombre_cliente']); ?></span></div>
                <div><strong>Nro. de Pedido</strong> <span><?php echo htmlspecialchars($_GET['id_venta']); ?></span></div>
                <div><strong>Total</strong> <span>$ <?php echo number_format((float)$_GET['total'], 2); ?></span></div>
            </div>

            <button type="button" onclick="window.location.href='index.php'">Seguir Comprando</button>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>