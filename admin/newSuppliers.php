<?php
session_start();

// Verificar si el usuario ha iniciado sesión y si es un administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['clasificacion'] !== 'Administrador') {
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
    <div class="container">
        <h1>Agregar Nuevo Proveedor</h1>
        <!-- Formulario para agregar un nuevo proveedor -->
        <form action="./codes/codeNewSuppliers.php" method="POST">
            <!-- Nombre del proveedor -->
            <div class="form-group">
                <label for="nombre">Nombre del Proveedor:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" pattern="\d{9}" title="Debe contener 9 dígitos" required>
            </div>

            <!-- Correo -->
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion">
            </div>

            <!-- Botón de enviar -->
            <div class="form-group">
                <button type="submit">Agregar Proveedor</button>
            </div>
        </form>
    </div>
</body>

</html>