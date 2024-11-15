<?php
include './database/database.php';

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$tipo_busqueda = $_GET['tipo_busqueda'] ?? 'nombre';
$busqueda = $_GET['busqueda'] ?? null;

function obtenerProveedores($tipo_busqueda = 'nombre', $busqueda = null, $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT id_proveedor, nombre, telefono, correo, direccion FROM Proveedores";
    $params = [];
    $types = "";
    $filters = [];

    if ($busqueda) {
        switch ($tipo_busqueda) {
            case 'id':
                $filters[] = "id_proveedor = ?";
                $params[] = &$busqueda;
                $types .= "i";
                break;
            case 'nombre':
                $filters[] = "nombre LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
            case 'telefono':
                $filters[] = "telefono LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
            case 'correo':
                $filters[] = "correo LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
        }
    }

    if ($filters) {
        $query .= " WHERE " . implode(" AND ", $filters);
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
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function contarProveedores($tipo_busqueda = 'nombre', $busqueda = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Proveedores";
    $params = [];
    $types = "";
    $filters = [];

    if ($busqueda) {
        switch ($tipo_busqueda) {
            case 'id':
                $filters[] = "id_proveedor = ?";
                $params[] = &$busqueda;
                $types .= "i";
                break;
            case 'nombre':
                $filters[] = "nombre LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
            case 'telefono':
                $filters[] = "telefono LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
            case 'correo':
                $filters[] = "correo LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
        }
    }

    if ($filters) {
        $query .= " WHERE " . implode(" AND ", $filters);
    }

    $stmt = $conn->prepare($query);
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc()['total'];
}

$totalProveedores = contarProveedores($tipo_busqueda, $busqueda);
$totalPaginas = ceil($totalProveedores / $limit);
$proveedores = obtenerProveedores($tipo_busqueda, $busqueda, $offset, $limit);
?>

<!-- Renderizado de proveedores -->
<?php foreach ($proveedores as $proveedor): ?>
    <?php
    // Verificar si el proveedor tiene productos relacionados
    $queryProductos = "SELECT COUNT(*) AS total FROM productos WHERE id_proveedor = ?";
    $stmtProductos = $conn->prepare($queryProductos);
    $stmtProductos->bind_param('i', $proveedor['id_proveedor']);
    $stmtProductos->execute();
    $resultProductos = $stmtProductos->get_result();
    $totalProductos = $resultProductos->fetch_assoc()['total'];
    ?>
    <tr>
        <td><?= htmlspecialchars($proveedor['id_proveedor']) ?></td>
        <td><?= htmlspecialchars($proveedor['nombre']) ?></td>
        <td><?= htmlspecialchars($proveedor['telefono']) ?></td>
        <td><?= htmlspecialchars($proveedor['correo']) ?></td>
        <td><?= htmlspecialchars($proveedor['direccion']) ?></td>
        <td>
            <button class="edit-btn" onclick="window.location.href='../../editSuppliers.php?id_proveedor=<?= $proveedor['id_proveedor'] ?>'">Editar</button>
            <?php if ($totalProductos === 0): ?>
                <button class="delete-btn" onclick="confirmarBorrado(<?= $proveedor['id_proveedor'] ?>)">Borrar</button>
            <?php else: ?>
                <button class="delete-btn" disabled>No eliminable</button>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>