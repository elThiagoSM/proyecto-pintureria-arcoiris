<?php
include '../database/database.php'; // Conexión a la base de datos

// Obtener ventas en proceso con filtro y paginación
function obtenerVentasEnProceso($nombre_cliente = null, $offset = 0, $limit = 10)
{
    global $conn;
    $query = "
        SELECT Ventas.id_venta, Usuarios.nombre_usuario, Productos.nombre AS nombre_producto, Ventas.valor_de_venta 
        FROM Ventas
        JOIN Usuarios ON Ventas.id_usuario = Usuarios.id_usuario
        JOIN Productos ON Ventas.id_producto = Productos.id_producto
        WHERE Ventas.estado = 'en proceso'
    ";

    // Filtrar por nombre de cliente
    if ($nombre_cliente) {
        $query .= " AND Usuarios.nombre_usuario LIKE ?";
        $nombre_cliente = "%" . $nombre_cliente . "%";
    }

    // Agregar paginación
    $query .= " LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($query);

    if ($nombre_cliente) {
        $stmt->bind_param("sii", $nombre_cliente, $limit, $offset);
    } else {
        $stmt->bind_param("ii", $limit, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $ventas = [];
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
    return $ventas;
}

// Contar ventas para la paginación
function contarVentasEnProceso($nombre_cliente = null)
{
    global $conn;
    $query = "
        SELECT COUNT(*) as total FROM Ventas
        JOIN Usuarios ON Ventas.id_usuario = Usuarios.id_usuario
        WHERE Ventas.estado = 'en proceso'
    ";

    if ($nombre_cliente) {
        $query .= " AND Usuarios.nombre_usuario LIKE ?";
    }

    $stmt = $conn->prepare($query);

    if ($nombre_cliente) {
        $nombre_cliente = "%" . $nombre_cliente . "%";
        $stmt->bind_param("s", $nombre_cliente);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Procesar confirmación o cancelación de ventas
if (isset($_GET['action']) && isset($_GET['id_venta'])) {
    $idVenta = (int)$_GET['id_venta'];
    $action = $_GET['action'];

    if ($action == 'confirm') {
        $stmt = $conn->prepare("UPDATE Ventas SET estado = 'completado' WHERE id_venta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
    } elseif ($action == 'cancel') {
        $stmt = $conn->prepare("UPDATE Ventas SET estado = 'cancelado' WHERE id_venta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
    }
    header("Location: ../processSales.php");
    exit();
}

// Parámetros de paginación
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$nombre_cliente = $_GET['nombre_cliente'] ?? null;

// Obtener total de páginas
$totalVentas = contarVentasEnProceso($nombre_cliente);
$totalPaginas = ceil($totalVentas / $limit);

// Obtener ventas en proceso para la página actual
$ventasEnProceso = obtenerVentasEnProceso($nombre_cliente, $offset, $limit);
?>

<!-- Renderizado de ventas en proceso -->
<?php foreach ($ventasEnProceso as $venta): ?>
    <tr>
        <td><?= htmlspecialchars($venta['id_venta']) ?></td>
        <td><?= htmlspecialchars($venta['nombre_usuario']) ?></td>
        <td><?= htmlspecialchars($venta['nombre_producto']) ?></td>
        <td><?= htmlspecialchars($venta['valor_de_venta']) ?></td>
        <td>
            <button class="confirm-btn" onclick="confirmarVenta(<?= $venta['id_venta'] ?>)">Completar</button>
            <button class="cancel-btn" onclick="cancelarVenta(<?= $venta['id_venta'] ?>)">Cancelar</button>
        </td>
    </tr>
<?php endforeach; ?>