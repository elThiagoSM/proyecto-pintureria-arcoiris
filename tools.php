<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herramientas</title>
    <link rel="stylesheet" href="css/toolsStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <section class="tools">
        <div class="tools-container">
            <h2>Herramientas:</h2>
            <p class="subtext">Seleccione la herramienta que desea comprar.</p>

            <?php include 'codes/loadTools.php'; ?>

        </div>
    </section>

    <?php include 'components/footer.php'; ?>
</body>

</html>