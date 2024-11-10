<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Producto</title>
    <link rel="stylesheet" href="css/buyProductStyles.css">
</head>

<body>
    <?php
    include 'components/header.php';
    include './database/database.php';

    if (isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];
        $query = "SELECT p.imagen, p.nombre, p.descripcion, p.precio, p.stock_cantidad, p.marca, p.fecha_ingreso, 
                         pr.nombre AS proveedor_nombre,
                         pt.litros, pt.funcion_aplicacion, pt.terminacion, pc.nombre_color
                  FROM Productos p
                  LEFT JOIN Proveedores pr ON p.id_proveedor = pr.id_proveedor
                  LEFT JOIN Pinturas pt ON p.id_producto = pt.id_producto
                  LEFT JOIN PaletaColor pc ON pt.id_paleta = pc.id_paleta
                  WHERE p.id_producto = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
    ?>

            <div class="buy-product">
                <div class="buy-product-container">
                    <div class="image-container">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['descripcion']; ?>">
                    </div>
                    <div class="details">
                        <div class="details-text">
                            <h2><?php echo $producto['nombre']; ?></h2>
                            <p><?php echo $producto['descripcion']; ?></p>
                            <p>Precio: $<?php echo $producto['precio']; ?></p>
                            <p>Stock: <?php echo $producto['stock_cantidad']; ?></p>
                            <p>Marca: <?php echo $producto['marca']; ?></p>
                            <p>Proveedor: <?php echo $producto['proveedor_nombre']; ?></p>
                            <p>Fecha de ingreso: <?php echo $producto['fecha_ingreso']; ?></p>

                            <label for="cantidad">Cantidad a comprar:</label>
                            <select id="cantidad" name="cantidad">
                                <?php for ($i = 1; $i <= $producto['stock_cantidad']; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>

                            <?php if ($producto['litros'] !== null) { ?>
                                <h3>Detalles de la Pintura</h3>
                                <p>Litros: <?php echo $producto['litros']; ?></p>
                                <p>Función de aplicación: <?php echo ucfirst($producto['funcion_aplicacion']); ?></p>
                                <p>Terminación: <?php echo ucfirst($producto['terminacion']); ?></p>
                                <p>Color: <?php echo $producto['nombre_color']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="buttons">
                            <button class="buy" onclick="comprarAhora(<?php echo $producto['precio']; ?>)">COMPRAR AHORA</button>
                            <button class="add-to-cart" onclick="agregarAlCarrito()">AGREGAR AL CARRITO</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function comprarAhora(precioUnitario) {
                    const cantidad = document.getElementById('cantidad').value;
                    const montoTotal = precioUnitario * cantidad;
                    window.location.href = `checkout.php?id_producto=<?php echo $id_producto; ?>&nombre_producto=<?php echo urlencode($producto['nombre']); ?>&monto_total=${montoTotal}&cantidad=${cantidad}`;
                }

                function agregarAlCarrito() {
                    const id_producto = <?php echo json_encode($id_producto); ?>;
                    const nombre = <?php echo json_encode($producto['nombre']); ?>;
                    const precio = <?php echo json_encode($producto['precio']); ?>;
                    const cantidad = document.getElementById('cantidad').value;

                    const producto = {
                        id: id_producto,
                        nombre: nombre,
                        precio: precio,
                        cantidad: parseInt(cantidad)
                    };

                    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                    const index = carrito.findIndex(item => item.id === producto.id);

                    if (index > -1) {
                        carrito[index].cantidad += producto.cantidad;
                    } else {
                        carrito.push(producto);
                    }

                    localStorage.setItem('carrito', JSON.stringify(carrito));
                    alert('Producto agregado al carrito');
                }
            </script>

    <?php
        } else {
            echo "<p>Producto no encontrado.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>ID de producto no especificado.</p>";
    }

    $conn->close();
    ?>

    <?php include 'components/featuredProducts.php'; ?>
    <?php include 'components/footer.php'; ?>
</body>

</html>