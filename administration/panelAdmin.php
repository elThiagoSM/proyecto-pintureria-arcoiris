<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Productos</title>
    <link rel="stylesheet" href="styles/panelAdmin.css">
</head>
<body>
    <div class="container">
        <!-- Barra de navegación izquierda -->
        <nav class="sidebar">
            <ul>
                <li><a href="#" onclick="showSection('add')">Añadir Producto</a></li>
                <li><a href="#" onclick="showSection('edit')">Modificar Producto</a></li>
                <li><a href="#" onclick="showSection('delete')">Eliminar Producto</a></li>
                <li><a href="#" onclick="showSection('search')">Buscar Producto</a></li>
            </ul>
        </nav>

        <!-- Contenido principal -->
        <div class="main-content">
            <!-- Sección para el formulario de añadir producto -->
            <section id="add" class="section-content">
                <h2>Añadir Producto</h2>
                <form onsubmit="handleFormSubmit(event)">
                    <input type="hidden" name="accion" value="agregar">
                    <label for="marca">Marca del Producto:</label>
                    <input type="text" id="marca" name="marca" required><br>

                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" required><br>

                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" required step="0.01"><br>

                    <button type="submit">Agregar Producto</button>
                </form>
            </section>

            <!-- Sección para el formulario de modificar producto -->
            <section id="edit" class="section-content" style="display: none;">
                <h2>Modificar Producto</h2>
                <form onsubmit="handleFormSubmit(event)">
                    <input type="hidden" name="accion" value="editar">
                    <label for="id_producto">ID del Producto:</label>
                    <input type="text" id="id_producto" name="id_producto" required><br>

                    <label for="marca">Nueva Marca del Producto:</label>
                    <input type="text" id="marca" name="marca"><br>

                    <label for="descripcion">Nueva Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion"><br>

                    <label for="precio">Nuevo Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01"><br>

                    <button type="submit">Modificar Producto</button>
                </form>
            </section>

            <!-- Sección para el formulario de eliminar producto -->
            <section id="delete" class="section-content" style="display: none;">
                <h2>Eliminar Producto</h2>
                <form onsubmit="handleFormSubmit(event)">
                    <input type="hidden" name="accion" value="eliminar">
                    <label for="id_producto">ID del Producto a Eliminar:</label>
                    <input type="text" id="id_producto" name="id_producto" required><br>

                    <button type="submit">Eliminar Producto</button>
                </form>
            </section>

            <!-- Sección para el formulario de búsqueda de producto -->
            <section id="search" class="section-content" style="display: none;">
                <h2>Buscar Producto</h2>
                <form onsubmit="searchProduct(event)">
                    <label for="search_query">Buscar por Marca o Descripción:</label>
                    <input type="text" id="search_query" name="search_query" required><br>

                    <button type="submit">Buscar</button>
                </form>
                <!-- Resultado de la búsqueda -->
                <div id="search-result"></div>
            </section>

            <!-- Lista de productos, siempre visible -->
            <section id="product-list" class="section-content">
                <h2>Lista de Productos</h2>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                    <?php
                    include '../database/database.php';

                    // Ejecutar consulta para obtener productos
                    $result = $conn->query('SELECT * FROM productos');
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>{$row['id_producto']}</td><td>{$row['marca']}</td><td>{$row['descripción']}</td><td>{$row['precio']}</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Error al obtener los datos</td></tr>";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </table>
            </section>

            <!-- Área para mostrar mensajes de notificación -->
            <div id="notification" style="color: green; font-weight: bold;"></div>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar secciones de formulario
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section-content');
            sections.forEach(section => {
                section.style.display = section.id === sectionId || section.id === 'product-list' ? 'block' : 'none';
            });
        }

        // Función para manejar el envío del formulario con AJAX
        function handleFormSubmit(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario
            const form = event.target;
            const formData = new FormData(form);

            fetch('adminProductos.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('notification').innerText = data;
                setTimeout(() => location.reload(), 1500); // Recarga para actualizar la lista después de 1.5 segundos
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('notification').innerText = 'Hubo un error en la operación.';
            });
        }

        // Función para manejar la búsqueda de producto
        function searchProduct(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario
            const query = document.getElementById('search_query').value;

            fetch(`adminProductos.php?search_query=${encodeURIComponent(query)}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('search-result').innerHTML = data; // Muestra el resultado en la página
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('search-result').innerText = 'Hubo un error en la búsqueda.';
            });
        }
    </script>
</body>
</html>
