<?php
include '../database/database.php';

function obtenerVentasEnProceso($nombre_cliente = null, $id_venta = null, $offset = 0, $limit = 10)
{
    global $conn;
    $query = "
        SELECT ventas.id_venta, clientes.id_cliente, clientes.nombre_cliente, productos.nombre AS nombre_producto, ventas.valor_de_venta, ventas.cantidad
        FROM ventas
        JOIN clientes ON ventas.id_cliente = clientes.id_cliente
        JOIN productos ON ventas.id_producto = productos.id_producto
        WHERE ventas.estado = 'en proceso'
    ";

    $params = [];
    $types = "";

    if ($nombre_cliente) {
        $query .= " AND Clientes.nombre_cliente LIKE ?";
        $nombre_cliente = "%" . $nombre_cliente . "%";
        $params[] = &$nombre_cliente;
        $types .= "s";
    } elseif ($id_venta) {
        $query .= " AND Ventas.id_venta = ?";
        $params[] = &$id_venta;
        $types .= "i";
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

    $ventas = [];
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
    return $ventas;
}

function contarVentasEnProceso($nombre_cliente = null, $id_venta = null)
{
    global $conn;
    $query = "
        SELECT COUNT(*) as total FROM ventas
        JOIN clientes ON ventas.id_cliente = clientes.id_cliente
        WHERE ventas.estado = 'en proceso'
    ";

    if ($nombre_cliente) {
        $query .= " AND Clientes.nombre_cliente LIKE ?";
        $stmt = $conn->prepare($query);
        $nombre_cliente = "%" . $nombre_cliente . "%";
        $stmt->bind_param("s", $nombre_cliente);
    } elseif ($id_venta) {
        $query .= " AND Ventas.id_venta = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_venta);
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

$nombre_cliente = $_GET['nombre_cliente'] ?? null;
$id_venta = $_GET['id_venta'] ?? null;

$totalVentas = contarVentasEnProceso($nombre_cliente, $id_venta);
$totalPaginas = ceil($totalVentas / $limit);

$ventasEnProceso = obtenerVentasEnProceso($nombre_cliente, $id_venta, $offset, $limit);
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