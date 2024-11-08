<?php
include '../database/database.php'; // Conexión a la base de datos

function obtenerProductos($categoria = null, $busqueda = null, $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT Productos.id_producto, Productos.imagen, Productos.nombre, Productos.descripcion, Productos.precio, Productos.stock_cantidad FROM Productos";

    // Filtro de categoría
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

    // Condiciones adicionales
    $query .= " WHERE 1=1";
    $params = [];
    $types = "";

    if ($busqueda) {
        $query .= " AND Productos.nombre LIKE ?";
        $busqueda_param = "%" . $busqueda . "%";
        $params[] = &$busqueda_param;
        $types .= "s";
    }

    $query .= " LIMIT ? OFFSET ?";
    $params[] = &$limit;
    $params[] = &$offset;
    $types .= "ii";

    // Preparar y ejecutar consulta
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

// Obtener número total de productos para paginación
function contarProductos($categoria = null, $busqueda = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Productos";

    // Filtro de categoría
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
        $query .= " AND Productos.nombre LIKE ?";
        $stmt = $conn->prepare($query);
        $busqueda_param = "%" . $busqueda . "%";
        $stmt->bind_param("s", $busqueda_param);
    } else {
        $stmt = $conn->prepare($query);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Parámetros de paginación
$limit = 10;  // productos por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$categoria = $_GET['categoria'] ?? null;
$busqueda = $_GET['busqueda'] ?? null;
$totalProductos = contarProductos($categoria, $busqueda);
$totalPaginas = ceil($totalProductos / $limit);

$productos = obtenerProductos($categoria, $busqueda, $offset, $limit);
?>

<!-- Renderizado de productos -->
<?php foreach ($productos as $producto): ?>
    <tr>
        <td><img src="<?= $producto['imagen'] ?>" alt="Producto" width="50"></td>
        <td><?= htmlspecialchars($producto['nombre']) ?></td>
        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
        <td><?= number_format($producto['precio'], 2) ?></td>
        <td><?= htmlspecialchars($producto['stock_cantidad']) ?></td>
        <td>
            <button class="edit-btn" data-id="<?= $producto['id_producto'] ?>">Editar</button>
            <button class="delete-btn" onclick="confirmarBorrado(<?= $producto['id_producto'] ?>)">Borrar</button>
        </td>
    </tr>
<?php endforeach; ?>