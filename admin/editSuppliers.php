<?php
// Redirige a la página de inicio de sesión si no hay cookies de sesión activas
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    header("Location: loginAdmin.php");
    exit();
}

include './database/database.php';

$id_proveedor = $_GET['id_proveedor'] ?? null;
if (!$id_proveedor) {
    header("Location: suppliers.php");
    exit();
}

$query = "SELECT nombre, telefono, correo, direccion FROM proveedores WHERE id_proveedor = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_proveedor);
$stmt->execute();
$result = $stmt->get_result();
$proveedor = $result->fetch_assoc();

if (!$proveedor) {
    header("Location: suppliers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="./styles/editSuppliersStyles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Proveedor</h1>
        <form action="./codes/codeEditSuppliers.php" method="POST">
            <input type="hidden" name="id_proveedor" value="<?= htmlspecialchars($id_proveedor) ?>">

            <div class="form-group">
                <label for="nombre">Nombre del Proveedor:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($proveedor['nombre']) ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" pattern="\d{9}" title="Debe contener 9 dígitos" value="<?= htmlspecialchars($proveedor['telefono']) ?>" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($proveedor['correo']) ?>" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($proveedor['direccion']) ?>">
            </div>

            <div class="form-group">
                <button type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>
</body>

</html>