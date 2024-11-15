<?php
include './database/database.php';

function obtenerPaletasColores($busqueda = null, $tipo_busqueda = 'nombre_color', $offset = 0, $limit = 10)
{
    global $conn;

    $query = "SELECT id_paleta, codigo_de_color, nombre_color, tintes_utilizados FROM paletacolor WHERE 1=1";
    $params = [];
    $types = "";

    if ($busqueda) {
        if ($tipo_busqueda === 'id') {
            $query .= " AND id_paleta = ?";
            $params[] = $busqueda;
            $types .= "i";
        } else {
            $query .= " AND nombre_color LIKE ?";
            $params[] = "%" . $busqueda . "%";
            $types .= "s";
        }
    }

    $query .= " LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;
    $types .= "ii";

    $stmt = $conn->prepare($query);
    if ($types) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $paletas = [];
    while ($row = $result->fetch_assoc()) {
        $paletas[] = $row;
    }
    return $paletas;
}

function contarPaletasColores($busqueda = null, $tipo_busqueda = 'nombre_color')
{
    global $conn;

    $query = "SELECT COUNT(*) as total FROM paletacolor WHERE 1=1";
    if ($busqueda) {
        if ($tipo_busqueda === 'id') {
            $query .= " AND id_paleta = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $busqueda);
        } else {
            $query .= " AND nombre_color LIKE ?";
            $stmt = $conn->prepare($query);
            $busqueda_param = "%" . $busqueda . "%";
            $stmt->bind_param("s", $busqueda_param);
        }
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

$tipo_busqueda = $_GET['tipo_busqueda'] ?? 'nombre_color';
$busqueda = $_GET['busqueda'] ?? null;
$totalPaletas = contarPaletasColores($busqueda, $tipo_busqueda);
$totalPaginas = ceil($totalPaletas / $limit);

$paletas = obtenerPaletasColores($busqueda, $tipo_busqueda, $offset, $limit);
?>

<!-- Renderizado de paletas de colores -->
<?php foreach ($paletas as $paleta): ?>
    <?php
    // Verificar si la paleta está relacionada con pinturas
    $queryPinturas = "SELECT COUNT(*) AS total FROM pinturas WHERE id_paleta = ?";
    $stmtPinturas = $conn->prepare($queryPinturas);
    $stmtPinturas->bind_param('i', $paleta['id_paleta']);
    $stmtPinturas->execute();
    $resultPinturas = $stmtPinturas->get_result();
    $totalPinturas = $resultPinturas->fetch_assoc()['total'];
    ?>
    <tr>
        <td><?= htmlspecialchars($paleta['id_paleta']) ?></td>
        <td style="background-color: #<?= htmlspecialchars($paleta['codigo_de_color']) ?>; color: #FFF;">
            <?= htmlspecialchars($paleta['codigo_de_color']) ?>
        </td>
        <td><?= htmlspecialchars($paleta['nombre_color']) ?></td>
        <td><?= htmlspecialchars($paleta['tintes_utilizados']) ?></td>
        <td>
            <button class="edit-btn" onclick="window.location.href='../../editColorPalette.php?id_paleta=<?= $paleta['id_paleta'] ?>'">Editar</button>
            <?php if ($totalPinturas === 0): ?>
                <button class="delete-btn" onclick="confirmarBorradoPaleta(<?= $paleta['id_paleta'] ?>)">Borrar</button>
            <?php else: ?>
                <button class="delete-btn" disabled>No eliminable</button>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>