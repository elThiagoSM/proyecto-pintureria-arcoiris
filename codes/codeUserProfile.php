<?php
include '../database/database.php';
session_start();

// Verificar si el usuario está logueado usando la sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

// Obtener el ID del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];

// Sanitizar y validar los datos recibidos del formulario
$nombre_usuario = isset($_POST['nombre_usuario']) ? htmlspecialchars($_POST['nombre_usuario']) : null;
$direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : null;
$datos_contacto = isset($_POST['datos_contacto']) ? htmlspecialchars($_POST['datos_contacto']) : null;
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? htmlspecialchars($_POST['fecha_nacimiento']) : null;
$foto_perfil = $_FILES['foto_perfil'];

// Procesar la subida de la foto de perfil si hay un archivo seleccionado
$target_dir = "../uploads/profile_pictures/"; // Asegúrate de que esta carpeta exista y tenga permisos de escritura
$profile_picture_path = '';

if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
    $file_name = basename($foto_perfil['name']);
    $target_file = $target_dir . $file_name;
    if (move_uploaded_file($foto_perfil['tmp_name'], $target_file)) {
        $profile_picture_path = $target_file;
        $_SESSION['foto_perfil'] = $profile_picture_path; // Actualizar en la sesión
    }
}

// Preparar la consulta para actualizar datos
$sql = "UPDATE usuarios u 
        JOIN clientes c ON u.id_usuario = c.id_usuario
        SET u.nombre_usuario = ?, c.direccion = ?, c.datos_contacto = ?, c.fecha_nacimiento = ?";
$params = [$nombre_usuario, $direccion, $datos_contacto, $fecha_nacimiento];

if ($profile_picture_path) {
    $sql .= ", u.foto_perfil = ?";
    $params[] = $profile_picture_path;
}

$sql .= " WHERE u.id_usuario = ?";
$params[] = $id_usuario;

// Preparar y ejecutar la consulta con `mysqli`
$stmt = $conn->prepare($sql);

// Verificar si la consulta se preparó correctamente
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Crear los tipos para `bind_param` (todos son strings, excepto `fecha_nacimiento`)
$types = str_repeat("s", count($params)); // Generar un string de 's' del mismo tamaño que los parámetros

// Asociar los parámetros y ejecutar
$stmt->bind_param($types, ...$params);
$stmt->execute();

// Cerrar la declaración
$stmt->close();

// Redirigir con un mensaje de éxito
header("Location: ../userProfile.php?success=Perfil actualizado exitosamente");
exit();
