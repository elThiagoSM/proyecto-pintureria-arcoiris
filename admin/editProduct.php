<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es un administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['clasificacion'] !== 'Administrador') {
    header("Location: loginAdmin.php");
    exit();
}

include '../database/database.php';

// Obtener el ID del producto desde la URL y redirigir si no está presente
$id_producto = $_GET['id_producto'] ?? null;
if (!$id_producto) {
    header("Location: product.php");
    exit();
}

// Consultar los datos básicos del producto
$queryProducto = "SELECT * FROM Productos WHERE id_producto = ?";
$stmtProducto = $conn->prepare($queryProducto);
$stmtProducto->bind_param("i", $id_producto);
$stmtProducto->execute();
$producto = $stmtProducto->get_result()->fetch_assoc();
$stmtProducto->close();

// Consultar el tipo específico del producto y cargar los datos según su tipo
$tipoProducto = null;
$atributosEspecificos = [];

$queryTipo = [
    "Accesorio" => "SELECT * FROM Accesorios WHERE id_producto = ?",
    "MiniFerreteria" => "SELECT * FROM MiniFerreteria WHERE id_producto = ?",
    "Pintura" => "SELECT * FROM Pinturas WHERE id_producto = ?"
];

foreach ($queryTipo as $tipo => $sql) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $atributos = $stmt->get_result()->fetch_assoc();
    if ($atributos) {
        $tipoProducto = $tipo;
        $atributosEspecificos = $atributos;
        break;
    }
    $stmt->close();
}

// Consultar proveedores y paletas de color
$sqlProveedores = "SELECT id_proveedor, nombre FROM Proveedores";
$resultadoProveedores = $conn->query($sqlProveedores);

$sqlPaletas = "SELECT id_paleta, nombre_color FROM PaletaColor";
$resultadoPaletas = $conn->query($sqlPaletas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="./styles/editProductStyles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Producto</h1>

        <form action="./codes/codeEditProduct.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_producto" value="<?= $id_producto ?>">
            <input type="hidden" name="tipo_producto" value="<?= $tipoProducto ?>">

            <!-- Imagen del producto -->
            <div class="form-group">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                <img src="<?= $producto['imagen'] ?>" alt="Imagen actual" width="100">
            </div>

            <!-- Nombre del producto -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            </div>

            <!-- Precio -->
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>
            </div>

            <!-- Cantidad en stock -->
            <div class="form-group">
                <label for="stock_cantidad">Stock:</label>
                <input type="number" id="stock_cantidad" name="stock_cantidad" value="<?= $producto['stock_cantidad'] ?>" required>
            </div>

            <!-- Marca -->
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?= $producto['marca'] ?>">
            </div>

            <!-- Unidad -->
            <div class="form-group">
                <label for="unidad">Unidad:</label>
                <select id="unidad" name="unidad" required>
                    <option value="Litro" <?= $producto['unidad'] == 'Litro' ? 'selected' : '' ?>>Litro</option>
                    <option value="Kg" <?= $producto['unidad'] == 'Kg' ? 'selected' : '' ?>>Kg</option>
                    <option value="Cantidad" <?= $producto['unidad'] == 'Cantidad' ? 'selected' : '' ?>>Cantidad</option>
                </select>
            </div>

            <!-- Proveedor -->
            <div class="form-group">
                <label for="id_proveedor">Proveedor:</label>
                <select id="id_proveedor" name="id_proveedor" required>
                    <option value="">Seleccione un proveedor...</option>
                    <?php while ($row = $resultadoProveedores->fetch_assoc()): ?>
                        <option value="<?= $row['id_proveedor'] ?>" <?= $row['id_proveedor'] == $producto['id_proveedor'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Opciones específicas según el tipo de producto -->
            <?php if ($tipoProducto == 'Accesorio'): ?>
                <div class="form-group">
                    <h3>Opciones de Accesorio</h3>
                    <label for="medidas">Medidas:</label>
                    <input type="text" id="medidas" name="medidas" value="<?= htmlspecialchars($atributosEspecificos['medidas']) ?>">

                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($atributosEspecificos['tipo']) ?>">
                </div>
            <?php elseif ($tipoProducto == 'MiniFerreteria'): ?>
                <div class="form-group">
                    <h3>Opciones de Mini Ferretería</h3>
                    <label for="garantia">Garantía:</label>
                    <input type="text" id="garantia" name="garantia" value="<?= htmlspecialchars($atributosEspecificos['garantia']) ?>">
                </div>
            <?php elseif ($tipoProducto == 'Pintura'): ?>
                <div class="form-group">
                    <h3>Opciones de Pintura</h3>
                    <label for="litros">Litros:</label>
                    <input type="number" id="litros" name="litros" step="0.01" value="<?= $atributosEspecificos['litros'] ?>">

                    <label for="funcion_aplicacion">Función de Aplicación:</label>
                    <select id="funcion_aplicacion" name="funcion_aplicacion">
                        <option value="exterior" <?= $atributosEspecificos['funcion_aplicacion'] == 'exterior' ? 'selected' : '' ?>>Exterior</option>
                        <option value="interior" <?= $atributosEspecificos['funcion_aplicacion'] == 'interior' ? 'selected' : '' ?>>Interior</option>
                        <option value="metal" <?= $atributosEspecificos['funcion_aplicacion'] == 'metal' ? 'selected' : '' ?>>Metal</option>
                        <option value="madera" <?= $atributosEspecificos['funcion_aplicacion'] == 'madera' ? 'selected' : '' ?>>Madera</option>
                        <option value="sintetica" <?= $atributosEspecificos['funcion_aplicacion'] == 'sintetica' ? 'selected' : '' ?>>Sintética</option>
                        <option value="membrana" <?= $atributosEspecificos['funcion_aplicacion'] == 'membrana' ? 'selected' : '' ?>>Membrana</option>
                    </select>

                    <label for="id_paleta">Paleta de Color:</label>
                    <select id="id_paleta" name="id_paleta">
                        <option value="">Seleccione una paleta...</option>
                        <?php while ($row = $resultadoPaletas->fetch_assoc()): ?>
                            <option value="<?= $row['id_paleta'] ?>" <?= $row['id_paleta'] == $atributosEspecificos['id_paleta'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($row['nombre_color']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <label for="terminacion">Terminación:</label>
                    <select id="terminacion" name="terminacion">
                        <option value="mate" <?= $atributosEspecificos['terminacion'] == 'mate' ? 'selected' : '' ?>>Mate</option>
                        <option value="brillante" <?= $atributosEspecificos['terminacion'] == 'brillante' ? 'selected' : '' ?>>Brillante</option>
                        <option value="semimate" <?= $atributosEspecificos['terminacion'] == 'semimate' ? 'selected' : '' ?>>Semimate</option>
                        <option value="satinada" <?= $atributosEspecificos['terminacion'] == 'satinada' ? 'selected' : '' ?>>Satinada</option>
                    </select>

                    <label for="vencimiento">Vencimiento:</label>
                    <input type="date" id="vencimiento" name="vencimiento" value="<?= $atributosEspecificos['vencimiento'] ?? '' ?>">

                    <label for="lote">Lote:</label>
                    <input type="text" id="lote" name="lote" value="<?= htmlspecialchars($atributosEspecificos['lote'] ?? '') ?>">
                </div>
            <?php endif; ?>

            <!-- Botón de envío -->
            <div class="form-group">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>

</html>