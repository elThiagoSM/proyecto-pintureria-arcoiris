<?php
include '../database/database.php';
session_start();

// Verificar si el usuario está logueado
if (!isset($_COOKIE['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_COOKIE['id_usuario'];

// Sanitizar y validar los datos recibidos
$nombre_usuario = isset($_POST['nombre_usuario']) ? htmlspecialchars($_POST['nombre_usuario']) : null;
$direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : null;
$datos_contacto = isset($_POST['datos_contacto']) ? htmlspecialchars($_POST['datos_contacto']) : null;
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? htmlspecialchars($_POST['fecha_nacimiento']) : null;
$foto_perfil = $_FILES['foto_perfil'];

// Procesar la subida de la foto de perfil si hay un archivo seleccionado
$target_dir = "uploads/profile_pictures/";
$profile_picture_path = '';

if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
    $file_name = basename($foto_perfil['name']);
    $target_file = $target_dir . $file_name;
    if (move_uploaded_file($foto_perfil['tmp_name'], $target_file)) {
        $profile_picture_path = $target_file;
    }
}

// Preparar la actualización en la base de datos
$sql = "UPDATE Usuarios u JOIN Clientes c ON u.id_usuario = c.id_usuario
        SET u.nombre_usuario = ?, c.direccion = ?, c.datos_contacto = ?, c.fecha_nacimiento = ?";
$params = [$nombre_usuario, $direccion, $datos_contacto, $fecha_nacimiento];

if ($profile_picture_path) {
    $sql .= ", u.foto_perfil = ?";
    $params[] = $profile_picture_path;
}

$sql .= " WHERE u.id_usuario = ?";
$params[] = $id_usuario;

// Ejecutar la consulta preparada
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

header("Location: ../userProfile.php?success=Perfil actualizado exitosamente");
exit();
