<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Pinturas</title>
    <link rel="stylesheet" href="css/typesPaintingsStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <section class="types-paintings">
        <div class="types-paintings-container">
            <h2>Pinturas:</h2>
            <p class="subtext">Seleccione una pintura que desea comprar.</p>

            <?php include 'codes/loadPaintings.php'; ?>

        </div>
    </section>

    <?php include 'components/footer.php'; ?>
</body>

</html>