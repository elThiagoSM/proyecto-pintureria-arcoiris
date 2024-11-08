<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es un administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['clasificacion'] !== 'Administrador') {
    // Si no es administrador o no está autenticado, redirigir al inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="./styles/newProductStyles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>
        <?php
        include '../database/database.php';

        // Consultar proveedores
        $sql_proveedores = "SELECT id_proveedor, nombre FROM Proveedores";
        $resultado_proveedores = $conn->query($sql_proveedores);

        // Consultar paletas de color
        $sql_paletas = "SELECT id_paleta, nombre_color FROM PaletaColor";
        $resultado_paletas = $conn->query($sql_paletas);
        ?>

        <form action="./codes/codeNewProduct.php" method="POST" enctype="multipart/form-data">
            <!-- Imagen del producto -->
            <div class="form-group">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
            </div>

            <!-- Nombre del producto -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>

            <!-- Precio -->
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
            </div>

            <!-- Cantidad en stock -->
            <div class="form-group">
                <label for="stock_cantidad">Stock:</label>
                <input type="number" id="stock_cantidad" name="stock_cantidad" required>
            </div>

            <!-- Marca -->
            <div class="form-group">
                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca">
            </div>

            <!-- Unidad -->
            <div class="form-group">
                <label for="unidad">Unidad:</label>
                <select id="unidad" name="unidad" required>
                    <option value="Litro">Litro</option>
                    <option value="Kg">Kg</option>
                    <option value="Cantidad">Cantidad</option>
                </select>
            </div>

            <!-- Proveedor -->
            <div class="form-group">
                <label for="id_proveedor">Proveedor:</label>
                <select id="id_proveedor" name="id_proveedor" required>
                    <!-- Opciones de proveedores generadas dinámicamente -->
                    <option value="">Seleccione un proveedor...</option>
                    <?php
                    if ($resultado_proveedores->num_rows > 0) {
                        while ($row = $resultado_proveedores->fetch_assoc()) {
                            echo "<option value='" . $row['id_proveedor'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Tipo de Producto -->
            <div class="form-group">
                <label for="tipo_producto">Tipo de Producto:</label>
                <select id="tipo_producto" name="tipo_producto" onchange="mostrarOpcionesEspecificas()">
                    <option value="">Seleccione...</option>
                    <option value="Accesorio">Accesorio</option>
                    <option value="MiniFerreteria">Mini Ferretería</option>
                    <option value="Pintura">Pintura</option>
                </select>
            </div>

            <!-- Opciones específicas según el tipo -->
            <div id="opcionesAccesorio" class="opciones-especificas" style="display: none;">
                <h3>Opciones de Accesorio</h3>
                <div class="form-group">
                    <label for="medidas">Medidas:</label>
                    <input type="text" id="medidas" name="medidas">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" id="tipo" name="tipo">
                </div>
            </div>

            <div id="opcionesMiniFerreteria" class="opciones-especificas" style="display: none;">
                <h3>Opciones de Mini Ferretería</h3>
                <div class="form-group">
                    <label for="garantia">Garantía:</label>
                    <input type="text" id="garantia" name="garantia">
                </div>
            </div>

            <div id="opcionesPintura" class="opciones-especificas" style="display: none;">
                <h3>Opciones de Pintura</h3>
                <div class="form-group">
                    <label for="litros">Litros:</label>
                    <input type="number" id="litros" name="litros" step="0.01">
                </div>
                <div class="form-group">
                    <label for="funcion_aplicacion">Función de Aplicación:</label>
                    <select id="funcion_aplicacion" name="funcion_aplicacion">
                        <option value="exterior">Exterior</option>
                        <option value="interior">Interior</option>
                        <option value="metal">Metal</option>
                        <option value="madera">Madera</option>
                        <option value="sintetica">Sintética</option>
                        <option value="membrana">Membrana</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_paleta">Paleta de Color:</label>
                    <select id="id_paleta" name="id_paleta">
                        <!-- Opciones de paletas generadas dinámicamente -->
                        <option value="">Seleccione una paleta...</option>
                        <?php
                        if ($resultado_paletas->num_rows > 0) {
                            while ($row = $resultado_paletas->fetch_assoc()) {
                                echo "<option value='" . $row['id_paleta'] . "'>" . $row['nombre_color'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="terminacion">Terminación:</label>
                    <select id="terminacion" name="terminacion">
                        <option value="mate">Mate</option>
                        <option value="brillante">Brillante</option>
                        <option value="semimate">Semimate</option>
                        <option value="satinada">Satinada</option>
                    </select>
                </div>
            </div>

            <!-- Botón de enviar -->
            <div class="form-group">
                <button type="submit">Agregar Producto</button>
            </div>
        </form>

        <?php
        // Cerrar la conexión
        $conn->close();
        ?>
    </div>

    <script>
        // Función para mostrar/ocultar opciones específicas
        function mostrarOpcionesEspecificas() {
            // Ocultar todas las opciones específicas
            document.getElementById('opcionesAccesorio').style.display = 'none';
            document.getElementById('opcionesMiniFerreteria').style.display = 'none';
            document.getElementById('opcionesPintura').style.display = 'none';

            // Mostrar opciones según el tipo de producto seleccionado
            const tipoProducto = document.getElementById('tipo_producto').value;
            if (tipoProducto === 'Accesorio') {
                document.getElementById('opcionesAccesorio').style.display = 'block';
            } else if (tipoProducto === 'MiniFerreteria') {
                document.getElementById('opcionesMiniFerreteria').style.display = 'block';
            } else if (tipoProducto === 'Pintura') {
                document.getElementById('opcionesPintura').style.display = 'block';
            }
        }
    </script>
</body>

</html>