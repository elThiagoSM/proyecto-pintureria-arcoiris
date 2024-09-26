<?php
include '../database/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    // Prevenir inyecciones SQL
    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);

    // Consulta segura usando sentencias preparadas
    $stmt = $conn->prepare("SELECT * FROM Usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($contraseña, $user['contraseña'])) {
        // Guardar datos del usuario en cookies
        setcookie("nombre_usuario", $user['nombre_usuario'], time() + (86400 * 30), "/"); // 86400 = 1 día
        setcookie("correo", $user['correo'], time() + (86400 * 30), "/"); // Cookie para el correo
        setcookie("clasificacion", $user['clasificación'], time() + (86400 * 30), "/"); // Cookie para la clasificación

        // Iniciar sesión y redirigir al perfil de usuario
        header("Location: ../userProfile.php");
        exit();
    } else {
        // Fallo en el inicio de sesión
        echo "Usuario o contraseña incorrectos";
    }

    $stmt->close();
}
$conn->close();
