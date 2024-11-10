<?php
include '../../database/database.php'; // Conexión a la base de datos

// Verificar que las cookies están configuradas y el usuario es administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    header("Location: ../loginAdmin.php");
    exit();
}

// Cargar información del administrador desde la base de datos
$id_usuario = $_COOKIE['id_usuario'];
$sql = "SELECT nombre_usuario, correo, foto_perfil, clasificacion, fecha_ingreso FROM Usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Almacenar la información en cookies
    setcookie("correo", $user['correo'], 0, "/");
    setcookie("foto_perfil", $user['foto_perfil'], 0, "/");
    setcookie("fecha_ingreso", $user['fecha_ingreso'], 0, "/");
} else {
    echo "No se encontró la información del usuario.";
}

// Manejo de cierre de sesión
if (isset($_POST['logout'])) {
    // Eliminar cookies establecidas
    setcookie("id_usuario", "", time() - 3600, "/");
    setcookie("nombre_usuario", "", time() - 3600, "/");
    setcookie("correo", "", time() - 3600, "/");
    setcookie("clasificacion", "", time() - 3600, "/");
    setcookie("fecha_ingreso", "", time() - 3600, "/");
    setcookie("foto_perfil", "", time() - 3600, "/");

    header("Location: ../loginAdmin.php");
    exit();
}

// Cerrar conexión
$stmt->close();
$conn->close();
