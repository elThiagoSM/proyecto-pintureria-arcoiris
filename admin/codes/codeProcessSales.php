<?php
include '../database/database.php'; // Conexión a la base de datos

// Obtener ventas en proceso con filtro y paginación
function obtenerVentasEnProceso($nombre_cliente = null, $offset = 0, $limit = 10)
{
    global $conn;
    $query = "
        SELECT Ventas.id_venta, Clientes.id_cliente, Clientes.nombre_cliente, Productos.nombre AS nombre_producto, Ventas.valor_de_venta, Ventas.cantidad
        FROM Ventas
        JOIN Clientes ON Ventas.id_cliente = Clientes.id_cliente
        JOIN Productos ON Ventas.id_producto = Productos.id_producto
        WHERE Ventas.estado = 'en proceso'
    ";

    if ($nombre_cliente) {
        $query .= " AND Clientes.nombre_cliente LIKE ?";
        $nombre_cliente = "%" . $nombre_cliente . "%";
    }

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

// Contar ventas en proceso
function contarVentasEnProceso($nombre_cliente = null)
{
    global $conn;
    $query = "
        SELECT COUNT(*) as total FROM Ventas
        JOIN Clientes ON Ventas.id_cliente = Clientes.id_cliente
        WHERE Ventas.estado = 'en proceso'
    ";

    if ($nombre_cliente) {
        $query .= " AND Clientes.nombre_cliente LIKE ?";
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

// Confirmar o cancelar venta
if (isset($_GET['action']) && isset($_GET['id_venta'])) {
    $idVenta = (int)$_GET['id_venta'];
    $action = $_GET['action'];

    if ($action == 'confirm') {
        $stmt = $conn->prepare("UPDATE Ventas SET estado = 'completado' WHERE id_venta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
    } elseif ($action == 'cancel') {
        $stmt = $conn->prepare("SELECT id_producto, cantidad FROM Ventas WHERE id_venta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
        $result = $stmt->get_result();
        $venta = $result->fetch_assoc();

        if ($venta) {
            $idProducto = $venta['id_producto'];
            $cantidad = $venta['cantidad'];

            $stmtUpdate = $conn->prepare("UPDATE Productos SET stock_cantidad = stock_cantidad + ? WHERE id_producto = ?");
            $stmtUpdate->bind_param("ii", $cantidad, $idProducto);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }

        $stmt = $conn->prepare("DELETE FROM Ventas WHERE id_venta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
    }

    header("Location: ../processSales.php");
    exit();
}

// Paginación y filtros
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$nombre_cliente = $_GET['nombre_cliente'] ?? null;

$totalVentas = contarVentasEnProceso($nombre_cliente);
$totalPaginas = ceil($totalVentas / $limit);

$ventasEnProceso = obtenerVentasEnProceso($nombre_cliente, $offset, $limit);
?>

<!-- Renderizado de ventas en proceso -->
<?php foreach ($ventasEnProceso as $venta): ?>
    <tr>
        <td><?= htmlspecialchars($venta['id_venta']) ?></td>
        <td><?= htmlspecialchars($venta['id_cliente']) ?></td>
        <td><?= htmlspecialchars($venta['nombre_cliente']) ?></td>
        <td><?= htmlspecialchars($venta['nombre_producto']) ?></td>
        <td><?= htmlspecialchars($venta['cantidad']) ?></td>
        <td><?= htmlspecialchars($venta['valor_de_venta']) ?></td>
        <td>
            <button class="confirm-btn" onclick="confirmarVenta(<?= $venta['id_venta'] ?>)">Completar</button>
            <button class="cancel-btn" onclick="cancelarVenta(<?= $venta['id_venta'] ?>)">Cancelar</button>
        </td>
    </tr>
<?php endforeach; ?>