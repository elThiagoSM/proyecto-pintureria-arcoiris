<?php
include '../database/database.php'; // Conexión a la base de datos

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
        // Configurar cookies de sesión
        setcookie("id_usuario", $user['id_usuario'], 0, "/");
        setcookie("nombre_usuario", $user['nombre_usuario'], 0, "/");
        setcookie("correo", $user['correo'], 0, "/");
        setcookie("clasificacion", $user['clasificacion'], 0, "/");
        setcookie("fecha_ingreso", $user['fecha_ingreso'], 0, "/");
        setcookie("foto_perfil", $user['foto_perfil'], 0, "/");

        header("Location: ../dashboard.php");
        exit();
    } else {
        // Redirigir con mensaje de error en caso de contraseña incorrecta
        header("Location: ../loginAdmin.php?error=contraseña_incorrecta");
        exit();
    }
} else {
    // Redirigir con mensaje de error si no es administrador o no existe
    header("Location: ../loginAdmin.php?error=sin_permiso");
    exit();
}

// Cerrar conexión
$stmt->close();
$conn->close();
