<?php
include '../database/database.php'; // Conexión a la base de datos

// Iniciar la sesión
session_start();

// Obtener y validar los datos del formulario
$nombre_usuario = $conn->real_escape_string($_POST['nombre_usuario']);
$correo = $conn->real_escape_string($_POST['correo']);
$contraseña = password_hash($conn->real_escape_string($_POST['contraseña']), PASSWORD_BCRYPT); // Encriptar la contraseña
$clasificacion = $conn->real_escape_string($_POST['clasificacion']);
$token_verificacion = bin2hex(random_bytes(3)); // Generar un token de verificación

// Insertar datos en la tabla Usuarios
$sql_usuario = "INSERT INTO Usuarios (nombre_usuario, correo, contraseña, clasificacion, fecha_ingreso, correo_verificado, token_verificacion)
                VALUES ('$nombre_usuario', '$correo', '$contraseña', '$clasificacion', NOW(), 0, '$token_verificacion')";

if ($conn->query($sql_usuario) === TRUE) {
  // Si la inserción es exitosa, enviar un correo de verificación
  $asunto = "Verificación de Correo - Administrador de Pinturería Arcoiris";
  $verificacion_url = "http://localhost/proyecto-pintureria-arcoiris/verifyEmail.php?token=" . $token_verificacion . "&correo=" . urlencode($correo);
  $mensaje = "
<html>
<head>
  <title>Verificación de Correo</title>
</head>
<body style='font-family: Arial, sans-serif; color: #333;'>
  <h2>¡Bienvenido $nombre_usuario a Pinturería Arcoiris como Administrador!</h2>
  <p>Por favor, verifica tu correo electrónico haciendo clic en el siguiente enlace para activar tu cuenta de administrador:</p>
  <p style='text-align: left;'>
    <a href='$verificacion_url' style='display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #28a745; text-decoration: none; border-radius: 5px;'>Verificar Correo</a>
  </p>
  <p>O copia y pega el siguiente enlace en tu navegador:</p>
  <p><a href='$verificacion_url'>$verificacion_url</a></p>
  <hr>
  <p>Si no solicitaste este registro, por favor contacta con soporte inmediatamente.</p>
  <p style='font-size: 12px; color: #999;'>Pinturería Arcoiris &copy; " . date("Y") . "</p>
</body>
</html>";

  // Encabezados del correo
  $cabeceras = "From: no-reply@tu_sitio.com\r\n";
  $cabeceras .= "Reply-To: no-reply@tu_sitio.com\r\n";
  $cabeceras .= "MIME-Version: 1.0\r\n";
  $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

  // Preparar mensaje para el alert y redirección
  if (mail($correo, $asunto, $mensaje, $cabeceras)) {
    $alert_message = "Administrador agregado exitosamente. Se ha enviado un correo de verificación.";
  } else {
    $alert_message = "Administrador agregado, pero no se pudo enviar el correo de verificación.";
  }
} else {
  $alert_message = "Error al insertar administrador: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

// Mostrar el alert y redirigir a users.php
echo "<script>
    alert('$alert_message');
    window.location.href = '../users.php';
</script>";
exit();
