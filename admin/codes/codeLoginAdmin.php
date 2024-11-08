<?php
include '../../database/database.php'; // Conexión a la base de datos
session_start();

// Obtener los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contraseña = $_POST['contraseña'];

// Consulta para verificar usuario
$sql = "SELECT * FROM Usuarios WHERE nombre_usuario = ? AND clasificacion = 'Administrador'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar contraseña usando el hash almacenado
    if (password_verify($contraseña, $user['contraseña'])) {
        // Iniciar sesión y guardar datos del usuario
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
        $_SESSION['correo'] = $user['correo'];
        $_SESSION['clasificacion'] = $user['clasificacion'];
        $_SESSION['fecha_ingreso'] = $user['fecha_ingreso'];
        $_SESSION['foto_perfil'] = $user['foto_perfil'];

        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "No tienes permisos de administrador o el usuario no existe.";
}

// Cerrar conexión
$stmt->close();
$conn->close();
