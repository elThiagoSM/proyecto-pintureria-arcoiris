<?php
include '../database/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cliente = $_POST['nombre_cliente'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $datos_contacto = $_POST['datos_contacto'];

    // Verificar si las contraseñas coinciden
    if ($contraseña !== $confirmar_contraseña) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: ../register.php");
        exit;
    }

    // Sanitización de entrada
    $nombre_cliente = mysqli_real_escape_string($conn, $nombre_cliente);
    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);
    $correo = mysqli_real_escape_string($conn, $correo);
    $cedula = mysqli_real_escape_string($conn, $cedula);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $fecha_nacimiento);
    $direccion = mysqli_real_escape_string($conn, $direccion);
    $datos_contacto = mysqli_real_escape_string($conn, $datos_contacto);

    // Comprobar si el nombre de usuario o el correo ya existen
    $checkUserStmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
    $checkUserStmt->bind_param("ss", $nombre_usuario, $correo);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "El nombre de usuario o correo ya están registrados.";
        header("Location: ../register.php");
        exit;
    } else {
        $hashed_password = password_hash($contraseña, PASSWORD_BCRYPT);
        $token_verificacion = bin2hex(random_bytes(3));

        // Insertar en la tabla usuarios
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contraseña, correo, clasificacion, correo_verificado, token_verificacion) VALUES (?, ?, ?, 'Cliente', 0, ?)");
        $stmt->bind_param("ssss", $nombre_usuario, $hashed_password, $correo, $token_verificacion);

        if ($stmt->execute()) {
            $id_usuario = $stmt->insert_id;

            // Insertar en la tabla clientes
            $stmt_cliente = $conn->prepare("INSERT INTO clientes (nombre_cliente, correo, direccion, datos_contacto, fecha_nacimiento, cedula, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_cliente->bind_param("ssssssi", $nombre_cliente, $correo, $direccion, $datos_contacto, $fecha_nacimiento, $cedula, $id_usuario);
            $stmt_cliente->execute();
            $stmt_cliente->close();

            // Configuración y envío de correo de verificación
            // Configuración y envío de correo de verificación
            $asunto = "Verificación de Cuenta - Pinturería Arcoiris";
            $verificacion_url = "http://localhost/proyecto-pintureria-arcoiris/verifyEmail.php?token=" . $token_verificacion . "&correo=" . urlencode($correo);
            $mensaje = "
<html>
<head>
  <title>Verificación de Cuenta</title>
</head>
<body style='font-family: Arial, sans-serif; color: #333;'>
  <h2>¡Bienvenido a Pinturería Arcoiris, $nombre_cliente!</h2>
  <p>Gracias por registrarte. Para activar tu cuenta, por favor verifica tu correo electrónico haciendo clic en el siguiente enlace:</p>
  <p style='text-align: left;'>
    <a href='$verificacion_url' style='display: inline-block; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #28a745; text-decoration: none; border-radius: 5px;'>Verificar Cuenta</a>
  </p>
  <p>O copia y pega el siguiente enlace en tu navegador:</p>
  <p><a href='$verificacion_url'>$verificacion_url</a></p>
  <hr>
  <p>Si no creaste esta cuenta, por favor ignora este correo.</p>
  <p style='font-size: 12px; color: #999;'>Pinturería Arcoiris &copy; " . date("Y") . "</p>
</body>
</html>";

            // Encabezados del correo
            $cabeceras = "From: no-reply@tu_sitio.com\r\n";
            $cabeceras .= "Reply-To: no-reply@tu_sitio.com\r\n";
            $cabeceras .= "MIME-Version: 1.0\r\n";
            $cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";

            // Enviar el correo
            if (mail($correo, $asunto, $mensaje, $cabeceras)) {
                $_SESSION['success'] = "Registro exitoso. Revisa tu correo para confirmar tu cuenta.";
            } else {
                $_SESSION['error'] = "No se pudo enviar el correo de verificación.";
            }


            if (mail($correo, $asunto, $mensaje, $cabeceras)) {
                $_SESSION['success'] = "Registro exitoso. Revisa tu correo para confirmar tu cuenta.";
            } else {
                $_SESSION['error'] = "No se pudo enviar el correo de verificación.";
            }
        } else {
            $_SESSION['error'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkUserStmt->close();
    header("Location: ../register.php");
    exit;
}
$conn->close();
