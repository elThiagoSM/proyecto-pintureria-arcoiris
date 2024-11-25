<?php
include './database/database.php';
session_start();

// Verifica si ep token y correo estan en la URL
if (isset($_GET['token']) && isset($_GET['correo'])) {

    // Asigna los valores de token y correo recibidos en la URL
    $token = $_GET['token'];
    $correo = $_GET['correo'];

    // Buscar al usuario con el token y correo proporcionados
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND token_verificacion = ?");
    $stmt->bind_param("ss", $correo, $token);
    $stmt->execute();

    // Obtiene el resultado y lo guarda
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
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
