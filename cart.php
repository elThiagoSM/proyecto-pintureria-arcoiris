<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/cartStyles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="cart-container">
        <div class="cart-content">
            <h2 class="cart-title">Carrito de Compras</h2>

            <div id="cart-items" class="cart-items-container"></div>

            <div class="cart-total">
                <h3>Total: $<span id="cart-total">0</span></h3>
            </div>

            <button class="checkout-button">Proceder a la Compra</button>
        </div>
    </div>

    <script>
        function cargarCarrito() {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const cartItemsContainer = document.getElementById('cart-items');
            let total = 0;
            cartItemsContainer.innerHTML = '';

            if (carrito.length === 0) {
                cartItemsContainer.innerHTML = '<p>El carrito está vacío.</p>';
                document.getElementById('cart-total').innerText = '0';
                return;
            }

            carrito.forEach((producto, index) => {
                const subtotal = producto.precio * producto.cantidad;
                total += subtotal;

                cartItemsContainer.innerHTML += `
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <h4>${producto.nombre}</h4>
                            <p>Precio: $${producto.precio}</p>
                            <p>Cantidad: ${producto.cantidad}</p>
                        </div>
                        <div class="cart-item-subtotal">
                            <p>Subtotal: $${subtotal}</p>
                            <button onclick="eliminarProducto(${index})" class="remove-button">Eliminar</button>
                            <button onclick="comprarProducto(${producto.id})" class="buy-button">Comprar</button>
                        </div>
                    </div>
                `;
            });

            document.getElementById('cart-total').innerText = total;
        }

        function eliminarProducto(index) {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            const confirmar = confirm('¿Estás seguro de que deseas eliminar este producto del carrito?');
            if (confirmar) {
                carrito.splice(index, 1); // Eliminar el producto del carrito
                localStorage.setItem('carrito', JSON.stringify(carrito)); // Guardar de nuevo en el localStorage
                cargarCarrito(); // Actualizar la vista del carrito
            }
        }

        function comprarProducto(idProducto) {
            // Redirigir a buyProduct.php con el id del producto
            window.location.href = `buyProduct.php?id_producto=${idProducto}`;
        }

        window.onload = cargarCarrito;
    </script>

    <?php include 'components/featuredProducts.php'; ?>
    <?php include 'components/footer.php'; ?>
</body>

</html>