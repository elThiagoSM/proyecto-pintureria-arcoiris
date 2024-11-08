<?php
include '../database/database.php'; // Conexión a la base de datos

// Obtener y validar los datos del formulario
$nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
$correo = $conn->real_escape_string($_POST['correo']);
$contraseña = password_hash($conn->real_escape_string($_POST['contraseña']), PASSWORD_BCRYPT); // Encriptar la contraseña
$clasificacion = $conn->real_escape_string($_POST['clasificacion']);

// Insertar datos en la tabla Usuarios
$sql_usuario = "INSERT INTO Usuarios (nombre_usuario, correo, contraseña, clasificacion, fecha_ingreso)
                VALUES ('$nombre_usuario', '$correo', '$contraseña', '$clasificacion', NOW())";

if ($conn->query($sql_usuario) === TRUE) {
    echo "Administrador agregado exitosamente.";
} else {
    echo "Error al insertar administrador: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
