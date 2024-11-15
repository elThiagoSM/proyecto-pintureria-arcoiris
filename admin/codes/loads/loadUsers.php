<?php
include './database/database.php'; // Conexión a la base de datos

// Parámetros de paginación y filtros
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$clasificacion = $_GET['clasificacion'] ?? 'Cliente'; // Mostrar clientes por defecto
$tipo_busqueda = $_GET['tipo_busqueda'] ?? 'nombre';
$busqueda = $_GET['busqueda'] ?? null;

// Función para obtener los usuarios con filtros y paginación
function obtenerUsuarios($clasificacion = 'Cliente', $tipo_busqueda = 'nombre', $busqueda = null, $offset = 0, $limit = 10)
{
    global $conn;

    if ($clasificacion === 'Cliente') {
        // Query para obtener clientes con datos de la tabla usuarios y clientes
        $query = "SELECT u.id_usuario, c.id_cliente, u.nombre_usuario, u.correo, u.correo_verificado, u.clasificacion, 
                         u.fecha_ingreso, u.fecha_actualizacion, u.foto_perfil,
                         c.nombre_cliente, c.direccion, c.datos_contacto, c.fecha_nacimiento, c.cedula 
                  FROM usuarios u
                  JOIN clientes c ON u.id_usuario = c.id_usuario";
    } else {
        // Query para obtener administradores solo con datos de la tabla usuarios
        $query = "SELECT id_usuario, NULL AS id_cliente, nombre_usuario, correo, correo_verificado, clasificacion, 
                         fecha_ingreso, fecha_actualizacion, foto_perfil
                  FROM usuarios";
    }

    $query .= " WHERE clasificacion = ?";
    $params = [&$clasificacion];
    $types = "s";

    // Filtros adicionales según el tipo de búsqueda
    if ($busqueda) {
        switch ($tipo_busqueda) {
            case 'id':
                $query .= " AND id_usuario = ?";
                $params[] = &$busqueda;
                $types .= "i";
                break;
            case 'nombre':
                $query .= " AND nombre_usuario LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
            case 'correo':
                $query .= " AND correo LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
        }
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

function contarUsuarios($clasificacion = 'Cliente', $tipo_busqueda = 'nombre', $busqueda = null)
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM usuarios u";
    $params = [];
    $types = "";

    if ($clasificacion === 'Cliente') {
        $query .= " JOIN clientes c ON u.id_usuario = c.id_usuario";
    }

    $query .= " WHERE clasificacion = ?";
    $params[] = &$clasificacion;
    $types = "s";

    if ($busqueda) {
        switch ($tipo_busqueda) {
            case 'id':
                $query .= " AND id_usuario = ?";
                $params[] = &$busqueda;
                $types .= "i";
                break;
            case 'nombre':
                $query .= " AND nombre_usuario LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
            case 'correo':
                $query .= " AND correo LIKE ?";
                $busqueda_param = "%" . $busqueda . "%";
                $params[] = &$busqueda_param;
                $types .= "s";
                break;
        }
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
<!-- Renderizado de usuarios -->
<?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><img src="<?= htmlspecialchars($usuario['foto_perfil']) ?>" alt="<?= htmlspecialchars($usuario['nombre_usuario']) ?>" width="50"></td>

        <!-- Mostrar id_cliente para clientes y id_usuario para administradores -->
        <td>
            <?= $clasificacion === 'Cliente' ? htmlspecialchars($usuario['id_cliente']) : htmlspecialchars($usuario['id_usuario']) ?>
        </td>

        <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
        <td><?= htmlspecialchars($usuario['correo']) ?></td>
        <td><?= $usuario['correo_verificado'] ? 'Verificado' : 'No Verificado' ?></td>
        <td><?= htmlspecialchars($usuario['clasificacion']) ?></td>
        <td><?= htmlspecialchars($usuario['fecha_ingreso']) ?></td>
        <td><?= htmlspecialchars($usuario['fecha_actualizacion']) ?></td>

        <?php if ($clasificacion === 'Cliente'): ?>
            <td><?= htmlspecialchars($usuario['nombre_cliente']) ?></td>
            <td><?= htmlspecialchars($usuario['direccion']) ?></td>
            <td><?= htmlspecialchars($usuario['datos_contacto']) ?></td>
            <td><?= htmlspecialchars($usuario['fecha_nacimiento']) ?></td>
            <td><?= htmlspecialchars($usuario['cedula']) ?></td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>