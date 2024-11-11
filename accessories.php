<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesorios</title>
    <link rel="stylesheet" href="css/accessoriesStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <section class="accessories">
        <div class="accessories-container">
            <h2>Accesorios:</h2>
            <p class="subtext">Seleccione el accesorio que desea comprar.</p>

            <?php include 'codes/loadAccessories.php'; ?>

        </div>
    </section>

    <?php include 'components/footer.php'; ?>
</body>

</html>