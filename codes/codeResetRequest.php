<?php
include '../database/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];

    // Verificar si el correo está registrado
    $checkEmailStmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
    $checkEmailStmt->bind_param("s", $correo);
    $checkEmailStmt->execute();
    $result = $checkEmailStmt->get_result();

    if ($result->num_rows > 0) {
        // Generar token de recuperación
        $token = bin2hex(random_bytes(3));
        $updateTokenStmt = $conn->prepare("UPDATE usuarios SET token_verificacion = ? WHERE correo = ?");
        $updateTokenStmt->bind_param("ss", $token, $correo);
        $updateTokenStmt->execute();

        // Enviar correo con el enlace de recuperación
        $reset_url = "http://localhost/proyecto-pintureria-arcoiris/resetPassword.php?token=$token&correo=" . urlencode($correo);
        $asunto = "Recuperación de Contraseña - Pinturería Arcoiris";
        $mensaje = "
<html>
<head>
  <title>Recuperación de Contraseña</title>
</head>
<body>
  <h2>Recuperación de Contraseña</h2>
  <p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
  <p><a href='$reset_url'>Restablecer Contraseña</a></p>
  <p>O copia y pega el siguiente enlace en tu navegador:</p>
  <p><a href='$reset_url'>$reset_url</a></p>
</body>
</html>";

        $cabeceras = "From: no-reply@tu_sitio.com\r\n";
        $cabeceras .= "Reply-To: no-reply@tu_sitio.com\r\n";
        $cabeceras .= "MIME-Version: 1.0\r\n";
        $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

        if (mail($correo, $asunto, $mensaje, $cabeceras)) {
            $_SESSION['success'] = "Enlace de recuperación enviado. Revisa tu correo.";
        } else {
            $_SESSION['error'] = "No se pudo enviar el correo de recuperación.";
        }
    } else {
        $_SESSION['error'] = "Correo no registrado.";
    }

    $checkEmailStmt->close();
    header("Location: ../resetRequest.php");
    exit;
}
$conn->close();
