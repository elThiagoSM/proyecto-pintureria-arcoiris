<section id="add" class="section-content">
    <h2>Añadir Producto</h2>
    <form action="adminProductos.php" method="POST">
        <input type="hidden" name="accion" value="agregar">
        <label for="marca">Marca del Producto:</label>
        <input type="text" id="marca" name="marca" required><br>

        <label for="descripción">Descripción:</label>
        <input type="text" id="descripción" name="descripción" required><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required step="0.01"><br>

        <button type="submit">Agregar Producto</button>
    </form>
</section>

<section id="edit" class="section-content" style="display: none;">
    <h2>Modificar Producto</h2>
    <form action="adminProductos.php" method="POST">
        <input type="hidden" name="accion" value="editar">
        <label for="id_producto">ID del Producto:</label>
        <input type="text" id="id_producto" name="id_producto" required><br>

        <label for="marca">Nueva Marca del Producto:</label>
        <input type="text" id="marca" name="marca"><br>

        <label for="descripción">Nueva Descripción:</label>
        <input type="text" id="descripción" name="descripción"><br>

        <label for="precio">Nuevo Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01"><br>

        <button type="submit">Modificar Producto</button>
    </form>
</section>

<section id="delete" class="section-content" style="display: none;">
    <h2>Eliminar Producto</h2>
    <form action="adminProductos.php" method="POST">
        <input type="hidden" name="accion" value="eliminar">
        <label for="id_producto">ID del Producto a Eliminar:</label>
        <input type="text" id="id_producto" name="id_producto" required><br>

        <button type="submit">Eliminar Producto</button>
    </form>
</section>
