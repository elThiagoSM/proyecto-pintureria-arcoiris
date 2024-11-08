<?php
include '../database/database.php'; // Conexión a la base de datos

function obtenerProveedores($busqueda = null, $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT id_proveedor, nombre, telefono, correo, direccion FROM Proveedores";
    $params = [];
    $types = "";

    // Condición de búsqueda
    if ($busqueda) {
        $query .= " WHERE nombre LIKE ? OR correo LIKE ?";
        $busqueda_param = "%" . $busqueda . "%";
        $params[] = &$busqueda_param;
        $params[] = &$busqueda_param;
        $types .= "ss";
    }

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

    $proveedores = [];
    while ($row = $result->fetch_assoc()) {
        $proveedores[] = $row;
    }
    return $proveedores;
}

// Obtener el total de proveedores para la paginación
function contarProveedores($busqueda = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Proveedores";
    $params = [];
    $types = "";

    // Condición de búsqueda
    if ($busqueda) {
        $query .= " WHERE nombre LIKE ? OR correo LIKE ?";
        $busqueda_param = "%" . $busqueda . "%";
        $params[] = &$busqueda_param;
        $params[] = &$busqueda_param;
        $types .= "ss";
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

$busqueda = $_GET['busqueda'] ?? null;
$totalProveedores = contarProveedores($busqueda);
$totalPaginas = ceil($totalProveedores / $limit);

$proveedores = obtenerProveedores($busqueda, $offset, $limit);
?>

<!-- Renderizado de proveedores -->
<?php foreach ($proveedores as $proveedor): ?>
    <tr>
        <td><?= htmlspecialchars($proveedor['id_proveedor']) ?></td>
        <td><?= htmlspecialchars($proveedor['nombre']) ?></td>
        <td><?= htmlspecialchars($proveedor['telefono']) ?></td>
        <td><?= htmlspecialchars($proveedor['correo']) ?></td>
        <td><?= htmlspecialchars($proveedor['direccion']) ?></td>
        <td>
            <button class="edit-btn" data-id="<?= $proveedor['id_proveedor'] ?>">Editar</button>
            <button class="delete-btn" onclick="confirmarBorrado(<?= $proveedor['id_proveedor'] ?>)">Borrar</button>
        </td>
    </tr>
<?php endforeach; ?>