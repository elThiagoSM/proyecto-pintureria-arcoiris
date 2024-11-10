<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="css/cartStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="cart-container">
        <h2>Carrito de Compras</h2>
        <div id="cart-items"></div>

        <div class="cart-summary">
            <h3>Total: $<span id="cart-total">0</span></h3>
            <button onclick="procederCompra()" class="checkout-button">Proceder a la Compra</button>
        </div>
    </div>

    <script>
        // Cargar el carrito de `localStorage`
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
                        <h4>${producto.nombre}</h4>
                        <p>Precio: $${producto.precio}</p>
                        <p>Cantidad: 
                            <input type="number" value="${producto.cantidad}" min="1" 
                                   onchange="actualizarCantidad(${index}, this.value)">
                        </p>
                        <p>Subtotal: $<span id="subtotal-${index}">${subtotal}</span></p>
                        <button onclick="eliminarProducto(${index})" class="remove-button">Eliminar</button>
                    </div>
                `;
            });

            document.getElementById('cart-total').innerText = total;
        }

        // Actualizar la cantidad de un producto en el carrito
        function actualizarCantidad(index, nuevaCantidad) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito[index].cantidad = parseInt(nuevaCantidad);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            cargarCarrito();
        }

        // Eliminar un producto del carrito
        function eliminarProducto(index) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            cargarCarrito();
        }

        // Proceder a la compra (redirige a una página de checkout)
        function procederCompra() {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            if (carrito.length === 0) {
                alert('El carrito está vacío');
                return;
            }

            // Serializa el carrito en formato de URL para enviar a checkout.php
            const carritoData = encodeURIComponent(JSON.stringify(carrito));
            window.location.href = `checkout.php?carrito=${carritoData}`;
        }

        // Cargar el carrito al abrir la página
        cargarCarrito();
    </script>

    <?php include 'components/footer.php'; ?>
</body>

</html>