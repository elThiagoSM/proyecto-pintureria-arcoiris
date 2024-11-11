<?php
include '../database/database.php'; // Conexión a la base de datos

// Parámetros de paginación y filtros
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$forma_de_pago = $_GET['forma_de_pago'] ?? null;
$fecha_venta = $_GET['fecha_venta'] ?? null;
$id_venta = $_GET['id_venta'] ?? null;

// Función para obtener las ventas con filtros y paginación
function obtenerVentas($forma_de_pago = null, $fecha_venta = null, $id_venta = null, $offset = 0, $limit = 10)
{
    global $conn;

    // Crear consulta SQL base
    $query = "SELECT id_venta, forma_de_pago, fecha_de_venta, valor_de_venta, estado, datos_extra_notas, id_cliente, id_producto, cantidad FROM ventas";
    $params = [];
    $types = "";
    $filters = [];

    // Aplicar filtros según los parámetros recibidos
    if ($forma_de_pago) {
        $filters[] = "forma_de_pago = ?";
        $params[] = &$forma_de_pago;
        $types .= "s";
    }

    if ($fecha_venta) {
        $filters[] = "fecha_de_venta = ?";
        $params[] = &$fecha_venta;
        $types .= "s";
    }

    if ($id_venta) {
        $filters[] = "id_venta = ?";
        $params[] = &$id_venta;
        $types .= "i";
    }

    // Si hay filtros, agregarlos a la consulta
    if ($filters) {
        $query .= " WHERE " . implode(" AND ", $filters);
    }

    // Agregar paginación
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
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Función para contar las ventas (para la paginación)
function contarVentas($forma_de_pago = null, $fecha_venta = null, $id_venta = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM ventas";
    $params = [];
    $types = "";

    // Aplicar filtros para contar
    if ($forma_de_pago) {
        $query .= " WHERE forma_de_pago = ?";
        $params[] = &$forma_de_pago;
        $types .= "s";
    }

    if ($fecha_venta) {
        if ($forma_de_pago) {
            $query .= " AND fecha_de_venta = ?";
        } else {
            $query .= " WHERE fecha_de_venta = ?";
        }
        $params[] = &$fecha_venta;
        $types .= "s";
    }

    if ($id_venta) {
        if ($types) {
            $query .= " AND id_venta = ?";
        } else {
            $query .= " WHERE id_venta = ?";
        }
        $params[] = &$id_venta;
        $types .= "i";
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare($query);
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Obtener las ventas y el total para la paginación
$totalVentas = contarVentas($forma_de_pago, $fecha_venta, $id_venta);
$totalPaginas = ceil($totalVentas / $limit);
$ventas = obtenerVentas($forma_de_pago, $fecha_venta, $id_venta, $offset, $limit);
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
        <td><?= htmlspecialchars($venta['id_cliente']) ?></td>
        <td><?= htmlspecialchars($venta['id_producto']) ?></td>
        <td><?= htmlspecialchars($venta['cantidad']) ?></td>
    </tr>
<?php endforeach; ?>