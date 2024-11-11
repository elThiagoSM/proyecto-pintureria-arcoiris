<?php
// Verificar si las cookies están configuradas y si el usuario es un administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    // Si no es administrador o no está autenticado, redirigir al inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Proveedor</title>
    <link rel="stylesheet" href="./styles/newSuppliersStyles.css">
</head>

<body>
    <div class="new-supplier">
        <div class="new-supplier-container">
            <h1>Agregar Nuevo Proveedor</h1>
            <form action="./codes/codeNewSupplier.php" method="POST">
                <div class="form-group">
                    <input placeholder="Nombre del Proveedor" type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <input placeholder="Teléfono" type="text" id="telefono" name="telefono" pattern="\d{9}" title="Debe contener 9 dígitos" required>
                </div>

                <div class="form-group">
                    <input placeholder="Correo" type="email" id="correo" name="correo" required>
                </div>

                <div class="form-group">
                    <input placeholder="Dirección" type="text" id="direccion" name="direccion">
                </div>

                <div class="form-group">
                    <button type="submit">Agregar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>