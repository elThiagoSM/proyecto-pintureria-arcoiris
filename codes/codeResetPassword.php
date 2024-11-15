<?php
include '../database/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $correo = $_POST['correo'];
    $new_password = $_POST['new_password'];

    // Validar token y correo
    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE correo = ? AND token_verificacion = ?");
    $stmt->bind_param("ss", $correo, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Actualizar contraseña y eliminar token
        $updateStmt = $conn->prepare("UPDATE usuarios SET contraseña = ?, token_verificacion = NULL WHERE correo = ?");
        $updateStmt->bind_param("ss", $hashed_password, $correo);

        if ($updateStmt->execute()) {
            $_SESSION['success'] = "Contraseña actualizada correctamente.";
        } else {
            $_SESSION['error'] = "Error al actualizar la contraseña.";
        }
        $updateStmt->close();
    } else {
        $_SESSION['error'] = "Enlace de recuperación inválido o expirado.";
    }

    $stmt->close();
    header("Location: ../login.php");
    exit;
}
$conn->close();
