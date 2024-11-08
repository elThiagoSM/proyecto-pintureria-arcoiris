<?php
include '../database/database.php'; // Conexión a la base de datos

function obtenerUsuarios($clasificacion = null, $busqueda = null, $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT id_usuario, nombre_usuario, correo, clasificacion, fecha_ingreso, fecha_actualizacion, foto_perfil FROM Usuarios";
    $params = [];
    $types = "";

    // Filtro de clasificación
    if ($clasificacion) {
        $query .= " WHERE clasificacion = ?";
        $params[] = &$clasificacion;
        $types .= "s";
    }

    // Condición de búsqueda
    if ($busqueda) {
        if ($clasificacion) {
            $query .= " AND (nombre_usuario LIKE ? OR correo LIKE ?)";
        } else {
            $query .= " WHERE (nombre_usuario LIKE ? OR correo LIKE ?)";
        }
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

    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    return $usuarios;
}

// Obtener el total de usuarios para la paginación
function contarUsuarios($clasificacion = null, $busqueda = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Usuarios";
    $params = [];
    $types = "";

    // Filtro de clasificación
    if ($clasificacion) {
        $query .= " WHERE clasificacion = ?";
        $params[] = &$clasificacion;
        $types .= "s";
    }

    // Condición de búsqueda
    if ($busqueda) {
        if ($clasificacion) {
            $query .= " AND (nombre_usuario LIKE ? OR correo LIKE ?)";
        } else {
            $query .= " WHERE (nombre_usuario LIKE ? OR correo LIKE ?)";
        }
        $busqueda_param = "%" . $busqueda . "%";
        $params[] = &$busqueda_param;
        $params[] = &$busqueda_param;
        $types .= "ss";
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

// Parámetros de paginación
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$clasificacion = $_GET['clasificacion'] ?? null;
$busqueda = $_GET['busqueda'] ?? null;
$totalUsuarios = contarUsuarios($clasificacion, $busqueda);
$totalPaginas = ceil($totalUsuarios / $limit);

$usuarios = obtenerUsuarios($clasificacion, $busqueda, $offset, $limit);
?>

<!-- Renderizado de usuarios -->
<?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><img src=<?= htmlspecialchars($usuario['foto_perfil']) ?> alt=<?= htmlspecialchars($usuario['nombre_usuario']) ?> width="50"></td>
        <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
        <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
        <td><?= htmlspecialchars($usuario['correo']) ?></td>
        <td><?= htmlspecialchars($usuario['clasificacion']) ?></td>
        <td><?= htmlspecialchars($usuario['fecha_ingreso']) ?></td>
        <td><?= htmlspecialchars($usuario['fecha_actualizacion']) ?></td>
        <td>
            <button class="edit-btn" data-id="<?= $usuario['id_usuario'] ?>">Editar</button>
            <button class="delete-btn" onclick="confirmarBorrado(<?= $usuario['id_usuario'] ?>)">Borrar</button>
        </td>
    </tr>
<?php endforeach; ?>