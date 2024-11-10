<?php
include './database/database.php';
session_start();

if (isset($_GET['token']) && isset($_GET['correo'])) {
    $token = $_GET['token'];
    $correo = $_GET['correo'];

    // Buscar al usuario con el token y correo proporcionados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND token_verificacion = ?");
    $stmt->bind_param("ss", $correo, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Marcar el correo como verificado
        $stmt_update = $conn->prepare("UPDATE usuarios SET correo_verificado = 1 WHERE correo = ?");
        $stmt_update->bind_param("s", $correo);
        $stmt_update->execute();
        $stmt_update->close();

        $_SESSION['success'] = "Correo verificado exitosamente. Ahora puedes iniciar sesión.";
    } else {
        $_SESSION['error'] = "Enlace de verificación inválido o expirado.";
    }

    $stmt->close();
    header("Location: login.php");
    exit;
}

$conn->close();
