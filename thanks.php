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
            <h1>MUCHAS GRACIAS POR TU COMPRA!</h1>
            <p>Te enviaremos un e-mail de confirmación con los detalles del pedido</p>
            <p>
                Al completar la transferencia recordá <strong>enviarnos el comprobante</strong> a
                <a href="mailto:ferrecent@ferrecent.com">ferrecent@ferrecent.com</a> para agilizar el despacho del pedido.
            </p>

            <p>Depósito o transferencia bancaria a la siguiente cuenta:</p>
            <p>
                Cuenta Corriente en pesos N° 0783229537<br>
                Banco HSBC sucursal San Isidro<br>
                C.B.U. es: 15000329-00007832295378<br>
                a nombre de Anyway Network S.R.L.<br>
                C.U.I.T.: 30-70953195-2
            </p>

            <div class="order-details">
                <div><strong>Nombre</strong> <span>Thiago Silveira Machado</span></div>
                <div><strong>Nro. de Pedido</strong> <span>11631</span></div>
                <div><strong>Total</strong> <span>$ 89.020,00</span></div>
            </div>

            <button type="button" onclick="window.location.href='index.php'">Seguir Comprando</button>

        </div>
    </div>

    <?php include 'components/footer.php'; ?>
</body>

</html>