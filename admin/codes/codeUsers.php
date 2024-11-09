<?php
include '../database/database.php'; // Conexión a la base de datos

// Parámetros de paginación y filtros
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$clasificacion = $_GET['clasificacion'] ?? null;
$tipo_busqueda = $_GET['tipo_busqueda'] ?? 'nombre';
$busqueda = $_GET['busqueda'] ?? null;

// Función para obtener los usuarios con filtros y paginación
function obtenerUsuarios($clasificacion = null, $tipo_busqueda = 'nombre', $busqueda = null, $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT id_usuario, nombre_usuario, correo, clasificacion, fecha_ingreso, fecha_actualizacion, foto_perfil FROM Usuarios";
    $params = [];
    $types = "";
    $filters = [];

    if ($clasificacion) {
        $filters[] = "clasificacion = ?";
        $params[] = &$clasificacion;
        $types .= "s";
    }

    if ($busqueda) {
        switch ($tipo_busqueda) {
            case 'id':
                $filters[] = "id_usuario = ?";
                $params[] = &$busqueda;
                $types .= "i";
                break;
            case 'nombre':
                $filters[] = "nombre_usuario LIKE ?";
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

// Función para contar el total de usuarios (para la paginación)
function contarUsuarios($clasificacion = null, $tipo_busqueda = 'nombre', $busqueda = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM Usuarios";
    $params = [];
    $types = "";
    $filters = [];

    if ($clasificacion) {
        $filters[] = "clasificacion = ?";
        $params[] = &$clasificacion;
        $types .= "s";
    }

    if ($busqueda) {
        switch ($tipo_busqueda) {
            case 'id':
                $filters[] = "id_usuario = ?";
                $params[] = &$busqueda;
                $types .= "i";
                break;
            case 'nombre':
                $filters[] = "nombre_usuario LIKE ?";
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

// Obtener los usuarios y el total para la paginación
$totalUsuarios = contarUsuarios($clasificacion, $tipo_busqueda, $busqueda);
$totalPaginas = ceil($totalUsuarios / $limit);
$usuarios = obtenerUsuarios($clasificacion, $tipo_busqueda, $busqueda, $offset, $limit);
?>

<!-- Renderizado de usuarios -->
<?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><img src="<?= htmlspecialchars($usuario['foto_perfil']) ?>" alt="<?= htmlspecialchars($usuario['nombre_usuario']) ?>" width="50"></td>
        <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
        <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
        <td><?= htmlspecialchars($usuario['correo']) ?></td>
        <td><?= htmlspecialchars($usuario['clasificacion']) ?></td>
        <td><?= htmlspecialchars($usuario['fecha_ingreso']) ?></td>
        <td><?= htmlspecialchars($usuario['fecha_actualizacion']) ?></td>
        <td>
            <button class="edit-btn" data-id="<?= $usuario['id_usuario'] ?>">Editar</button>
        </td>
    </tr>
<?php endforeach; ?>