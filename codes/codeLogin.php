<?php
include '../database/database.php'; // Conexin a la base de datos
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    // Prevenir inyecciones SQL
    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);

    // Verificar usuario y contraseña
    $stmt = $conn->prepare("SELECT Usuarios.*, Clientes.* FROM Usuarios 
                            LEFT JOIN Clientes ON Usuarios.id_usuario = Clientes.id_usuario 
                            WHERE Usuarios.nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user_data = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contraseña, $user_data['contraseña'])) {
            // Establecer cookies con los datos del usuario
            setcookie('nombre_usuario', $user_data['nombre_usuario'], time() + 3600, "/");
            setcookie('correo', $user_data['correo'], time() + 3600, "/");
            setcookie('clasificacion', $user_data['clasificacion'], time() + 3600, "/");
            setcookie('direccion', $user_data['direccion'], time() + 3600, "/");
            setcookie('datos_contacto', $user_data['datos_contacto'], time() + 3600, "/");
            setcookie('fecha_nacimiento', $user_data['fecha_nacimiento'], time() + 3600, "/");
            setcookie('cedula', $user_data['cedula'], time() + 3600, "/");

            // Redirigir a la pagina de perfil de usuario
            header("Location: ../userProfile.php");
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../login.php?error=credenciales");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: ../login.php?error=credenciales");
        exit();
    }

    $stmt->close();
}
$conn->close();
