<?php
session_start();
include '../../database/database.php'; // Conexión a la base de datos

// Verificar que el usuario tiene una sesión activa y es administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['clasificacion'] !== 'Administrador') {
    header("Location: ../loginAdmin.php");
    exit();
}

// Cargar información del administrador desde la base de datos
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT nombre_usuario, correo, foto_perfil, clasificacion, fecha_ingreso FROM Usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Almacenar información en la sesión
    $_SESSION['correo'] = $user['correo'];
    $_SESSION['foto_perfil'] = $user['foto_perfil'];
    $_SESSION['fecha_ingreso'] = $user['fecha_ingreso'];
} else {
    echo "No se encontró la información del usuario.";
}

// Manejo de cierre de sesión
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../loginAdmin.php");
    exit();
}

// Cerrar conexión
$stmt->close();
$conn->close();
