<?php
include '../database/database.php'; // Conexión a la base de datos

function obtenerPaletas($offset = 0, $limit = 10)
{
    global $conn;
    $query = "SELECT id_paleta, codigo_de_color, nombre_color, tintes_utilizados FROM PaletaColor LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $paletas = [];
    while ($row = $result->fetch_assoc()) {
        $paletas[] = $row;
    }
    return $paletas;
}

// Obtener número total de paletas para la paginación
function contarPaletas()
{
    global $conn;
    $query = "SELECT COUNT(*) as total FROM PaletaColor";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Parámetros de paginación
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$totalPaletas = contarPaletas();
$totalPaginas = ceil($totalPaletas / $limit);

$paletas = obtenerPaletas($offset, $limit);
?>

<!-- Renderizado de paletas de colores -->
<?php foreach ($paletas as $paleta): ?>
    <tr>
        <td style="background-color: #<?= htmlspecialchars($paleta['codigo_de_color']) ?>;">#<?= htmlspecialchars($paleta['codigo_de_color']) ?></td>
        <td><?= htmlspecialchars($paleta['nombre_color']) ?></td>
        <td><?= htmlspecialchars($paleta['tintes_utilizados']) ?></td>
        <td>
            <button class="edit-btn" onclick="window.location.href='editColorPalette.php?id_paleta=<?= $paleta['id_paleta'] ?>'">Editar</button>
            <!-- <button class="delete-btn" onclick="confirmarBorrado(<?= $paleta['id_paleta'] ?>)">Borrar</button> -->
        </td>
    </tr>
<?php endforeach; ?>

<!-- Paginación -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">Anterior</a>
    <?php endif; ?>

    <span>Página <?= $page ?> de <?= $totalPaginas ?></span>

    <?php if ($page < $totalPaginas): ?>
        <a href="?page=<?= $page + 1 ?>">Siguiente</a>
    <?php endif; ?>
</div>