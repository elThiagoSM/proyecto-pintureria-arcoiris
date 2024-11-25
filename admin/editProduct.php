<?php
// Redirige a la página de inicio de sesión si no hay cookies de sesión activas
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    header("Location: loginAdmin.php");
    exit();
}

include './database/database.php';

// Obtener el ID del producto desde la URL y redirigir si no está presente
$id_producto = $_GET['id_producto'] ?? null;
if (!$id_producto) {
    header("Location: product.php");
    exit();
}

// Consultar los datos basicos del producto
$queryProducto = "SELECT * FROM productos WHERE id_producto = ?";
$stmtProducto = $conn->prepare($queryProducto);
$stmtProducto->bind_param("i", $id_producto);
$stmtProducto->execute();
$producto = $stmtProducto->get_result()->fetch_assoc();
$stmtProducto->close();

// Consultar el tipo especifico del producto y cargar los datos segun su tipo
$tipoProducto = null;
$atributosEspecificos = [];

$queryTipo = [
    "Accesorio" => "SELECT * FROM accesorios WHERE id_producto = ?",
    "MiniFerreteria" => "SELECT * FROM miniFerreteria WHERE id_producto = ?",
    "Pintura" => "SELECT * FROM pinturas WHERE id_producto = ?"
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
$sqlProveedores = "SELECT id_proveedor, nombre FROM proveedores";
$resultadoProveedores = $conn->query($sqlProveedores);

$sqlPaletas = "SELECT id_paleta, nombre_color FROM paletacolor";
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
    <div class="edit-product">
        <div class="edit-product-container">
            <h1>Editar Producto</h1>

            <form id="editProductForm" action="./codes/codeEditProduct.php" method="POST" enctype="multipart/form-data" class="form">
                <input type="hidden" name="id_producto" value="<?= $id_producto ?>">
                <input type="hidden" name="tipo_producto" value="<?= $tipoProducto ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input style="margin-bottom: 10px;" type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>

                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
                    </div>

                    <div class="form-group image-group">
                        <img src="<?= $producto['imagen'] ?>" alt="Imagen actual" class="product-image">
                        <input type="file" id="imagen" name="imagen" accept="image/*">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" step="0.01" value="<?= $producto['precio'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="stock_cantidad">Stock:</label>
                        <input type="number" id="stock_cantidad" name="stock_cantidad" value="<?= $producto['stock_cantidad'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="unidad">Unidad:</label>
                        <select id="unidad" name="unidad" required>
                            <option value="Litro" <?= $producto['unidad'] == 'Litro' ? 'selected' : '' ?>>Litro</option>
                            <option value="Kg" <?= $producto['unidad'] == 'Kg' ? 'selected' : '' ?>>Kg</option>
                            <option value="Cantidad" <?= $producto['unidad'] == 'Cantidad' ? 'selected' : '' ?>>Cantidad</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" value="<?= $producto['marca'] ?>">
                    </div>
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
                    <div class="form-group">
                        <label for="mostrar">Mostrar en Tienda:</label>
                        <input type="checkbox" id="mostrar" name="mostrar" <?= $producto['mostrar'] ? 'checked' : '' ?>>
                    </div>
                </div>

                <!-- Opciones Especificas por Tipo de Producto -->
                <?php if ($tipoProducto == 'Accesorio'): ?>
                    <h3>Opciones de Accesorio</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="medidas">Medidas:</label>
                            <input type="text" id="medidas" name="medidas" value="<?= htmlspecialchars($atributosEspecificos['medidas']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($atributosEspecificos['tipo']) ?>">
                        </div>
                    </div>

                <?php elseif ($tipoProducto == 'MiniFerreteria'): ?>
                    <h3>Opciones de Mini Ferretería</h3>
                    <div class="form-group">
                        <label for="garantia">Garantía:</label>
                        <input type="text" id="garantia" name="garantia" value="<?= htmlspecialchars($atributosEspecificos['garantia']) ?>">
                    </div>

                <?php elseif ($tipoProducto == 'Pintura'): ?>
                    <h3>Opciones de Pintura</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="litros">Litros:</label>
                            <input type="number" id="litros" name="litros" step="0.01" value="<?= $atributosEspecificos['litros'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="funcion_aplicacion">Función de Aplicación:</label>
                            <select id="funcion_aplicacion" name="funcion_aplicacion">
                                <option value="exterior" <?= $atributosEspecificos['funcion_aplicacion'] == 'exterior' ? 'selected' : '' ?>>Exterior</option>
                                <option value="interior" <?= $atributosEspecificos['funcion_aplicacion'] == 'interior' ? 'selected' : '' ?>>Interior</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="terminacion">Terminación:</label>
                            <select id="terminacion" name="terminacion">
                                <option value="mate" <?= $atributosEspecificos['terminacion'] == 'mate' ? 'selected' : '' ?>>Mate</option>
                                <option value="brillante" <?= $atributosEspecificos['terminacion'] == 'brillante' ? 'selected' : '' ?>>Brillante</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_paleta">Paleta de Color:</label>
                            <select id="id_paleta" name="id_paleta">
                                <?php while ($row = $resultadoPaletas->fetch_assoc()): ?>
                                    <option value="<?= $row['id_paleta'] ?>" <?= $row['id_paleta'] == $atributosEspecificos['id_paleta'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($row['nombre_color']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Botones de Accion -->
                <div class="action-buttons">
                    <a href="./products.php" class="cancel-button">Cancelar</a>
                    <button type="submit" class="save-button">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>