<?php
include './database/database.php';

function obtenerProductos($categoria = null, $busqueda = null, $tipo_busqueda = 'nombre', $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT Productos.id_producto, Productos.imagen, Productos.nombre, Productos.descripcion, Productos.precio, Productos.stock_cantidad FROM Productos";

    if ($categoria) {
        switch ($categoria) {
            case 'Pinturas':
                $query .= " INNER JOIN Pinturas ON Productos.id_producto = Pinturas.id_producto";
                break;
            case 'Accesorios':
                $query .= " INNER JOIN Accesorios ON Productos.id_producto = Accesorios.id_producto";
                break;
            case 'Mini Ferretería':
                $query .= " INNER JOIN MiniFerreteria ON Productos.id_producto = MiniFerreteria.id_producto";
                break;
        }
    }

    $query .= " WHERE 1=1";
    $params = [];
    $types = "";

    if ($busqueda) {
        if ($tipo_busqueda === 'id') {
            $query .= " AND Productos.id_producto = ?";
            $params[] = &$busqueda;
            $types .= "i";
        } else {
            $query .= " AND Productos.nombre LIKE ?";
            $busqueda_param = "%" . $busqueda . "%";
            $params[] = &$busqueda_param;
            $types .= "s";
        }
    }

    $query .= " LIMIT ? OFFSET ?";
    $params[] = &$limit;
    $params[] = &$offset;
    $types .= "ii";

    $stmt = $conn->prepare($query);
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
    return $productos;
}

function contarProductos($categoria = null, $busqueda = null, $tipo_busqueda = 'nombre')
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Productos";

    if ($categoria) {
        switch ($categoria) {
            case 'Pinturas':
                $query .= " INNER JOIN Pinturas ON Productos.id_producto = Pinturas.id_producto";
                break;
            case 'Accesorios':
                $query .= " INNER JOIN Accesorios ON Productos.id_producto = Accesorios.id_producto";
                break;
            case 'Mini Ferretería':
                $query .= " INNER JOIN MiniFerreteria ON Productos.id_producto = MiniFerreteria.id_producto";
                break;
        }
    }

    $query .= " WHERE 1=1";
    if ($busqueda) {
        if ($tipo_busqueda === 'id') {
            $query .= " AND Productos.id_producto = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $busqueda);
        } else {
            $query .= " AND Productos.nombre LIKE ?";
            $stmt = $conn->prepare($query);
            $busqueda_param = "%" . $busqueda . "%";
            $stmt->bind_param("s", $busqueda_param);
        }
    } else {
        $stmt = $conn->prepare($query);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$categoria = $_GET['categoria'] ?? null;
$tipo_busqueda = $_GET['tipo_busqueda'] ?? 'nombre';
$busqueda = $_GET['busqueda'] ?? null;
$totalProductos = contarProductos($categoria, $busqueda, $tipo_busqueda);
$totalPaginas = ceil($totalProductos / $limit);

$productos = obtenerProductos($categoria, $busqueda, $tipo_busqueda, $offset, $limit);
?>

<!-- Renderizado de productos -->
<?php foreach ($productos as $producto): ?>
    <?php
    // Verificar si el producto está relacionado con ventas
    $queryVentas = "SELECT COUNT(*) AS total FROM ventas WHERE id_producto = ?";
    $stmtVentas = $conn->prepare($queryVentas);
    $stmtVentas->bind_param('i', $producto['id_producto']);
    $stmtVentas->execute();
    $resultVentas = $stmtVentas->get_result();
    $totalVentas = $resultVentas->fetch_assoc()['total'];
    ?>
    <tr>
        <td><img src="<?= $producto['imagen'] ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" width="50"></td>
        <td><?= htmlspecialchars($producto['id_producto']) ?></td>
        <td><?= htmlspecialchars($producto['nombre']) ?></td>
        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
        <td><?= number_format($producto['precio'], 2) ?></td>
        <td><?= htmlspecialchars($producto['stock_cantidad']) ?></td>
        <td>
            <button class="edit-btn" onclick="window.location.href='../../editProduct.php?id_producto=<?= $producto['id_producto'] ?>'">Editar</button>
            <?php if ($totalVentas === 0): ?>
                <button class="delete-btn" onclick="confirmarBorradoProducto(<?= $producto['id_producto'] ?>)">Borrar</button>
            <?php else: ?>
                <button class="delete-btn" disabled>No eliminable</button>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>