<?php
include '../database/database.php';

function obtenerVentas($forma_de_pago = null, $fecha_venta = null, $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT id_venta, forma_de_pago, fecha_de_venta, valor_de_venta, estado, datos_extra_notas, id_usuario, id_producto FROM Ventas";
    $params = [];
    $types = "";

    // Filtro por forma de pago
    if ($forma_de_pago) {
        $query .= " WHERE forma_de_pago = ?";
        $params[] = &$forma_de_pago;
        $types .= "s";
    }

    // Condición de búsqueda por fecha de venta
    if ($fecha_venta) {
        if ($forma_de_pago) {
            $query .= " AND fecha_de_venta = ?";
        } else {
            $query .= " WHERE fecha_de_venta = ?";
        }
        $params[] = &$fecha_venta;
        $types .= "s";
    }

    // Paginación
    $query .= " LIMIT ? OFFSET ?";
    $params[] = &$limit;
    $params[] = &$offset;
    $types .= "ii";

    // Preparar y ejecutar la consulta
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

// Contar el total de ventas para la paginación
function contarVentas($forma_de_pago = null, $fecha_venta = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Ventas";
    $params = [];
    $types = "";

    // Filtro por forma de pago
    if ($forma_de_pago) {
        $query .= " WHERE forma_de_pago = ?";
        $params[] = &$forma_de_pago;
        $types .= "s";
    }

    // Condición de búsqueda por fecha de venta
    if ($fecha_venta) {
        if ($forma_de_pago) {
            $query .= " AND fecha_de_venta = ?";
        } else {
            $query .= " WHERE fecha_de_venta = ?";
        }
        $params[] = &$fecha_venta;
        $types .= "s";
    }

    $stmt = $conn->prepare($query);
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Parámetros de paginación
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$forma_de_pago = $_GET['forma_de_pago'] ?? null;
$fecha_venta = $_GET['fecha_venta'] ?? null;
$totalVentas = contarVentas($forma_de_pago, $fecha_venta);
$totalPaginas = ceil($totalVentas / $limit);

$ventas = obtenerVentas($forma_de_pago, $fecha_venta, $offset, $limit);
?>

<!-- Renderizado de ventas -->
<?php foreach ($ventas as $venta): ?>
    <tr>
        <td><?= htmlspecialchars($venta['id_venta']) ?></td>
        <td><?= htmlspecialchars($venta['forma_de_pago']) ?></td>
        <td><?= htmlspecialchars($venta['fecha_de_venta']) ?></td>
        <td><?= htmlspecialchars($venta['valor_de_venta']) ?></td>
        <td><?= htmlspecialchars($venta['estado']) ?></td>
        <td><?= htmlspecialchars($venta['datos_extra_notas']) ?></td>
        <td><?= htmlspecialchars($venta['id_usuario']) ?></td>
        <td><?= htmlspecialchars($venta['id_producto']) ?></td>
    </tr>
<?php endforeach; ?>