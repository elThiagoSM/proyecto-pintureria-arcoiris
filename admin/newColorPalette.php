<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Paleta de Colores</title>
    <link rel="stylesheet" href="./styles/newColorPaletteStyles.css">
</head>

<body>
    <div class="color-palette">
        <div class="color-palette-container">
            <h1>Agregar Nueva Paleta de Colores</h1>
            <form action="./codes/codeNewColorPalette.php" method="POST" class="new-palette-form">
                <div class="form-group">
                    <input type="color" id="codigo_color" name="codigo_color" required>
                    <label for="codigo_color">Código de Color</label>
                </div>

                <div class="form-group">
                    <input placeholder="Nombre del Color" type="text" id="nombre_color" name="nombre_color" required>
                </div>

                <div class="form-group">
                    <input placeholder="Tintes Utilizados" type="text" id="tintes_utilizados" name="tintes_utilizados" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Guardar Paleta</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>