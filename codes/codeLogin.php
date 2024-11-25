<?php
include '../database/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    // Escapar entradas para prevenir inyecciones SQL
    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);

    // Consulta SQL para verificar usuario y datos adicionales
    $stmt = $conn->prepare("
        SELECT usuarios.*, 
               clientes.id_cliente, 
               clientes.nombre_cliente, 
               clientes.direccion, 
               clientes.datos_contacto, 
               clientes.fecha_nacimiento, 
               clientes.cedula
        FROM usuarios 
        LEFT JOIN clientes ON usuarios.id_usuario = clientes.id_usuario 
        WHERE usuarios.nombre_usuario = ? 
        AND usuarios.correo_verificado = 1
    ");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user_data = $result->fetch_assoc();

        // Verificar contraseña
        if (password_verify($contraseña, $user_data['contraseña'])) {
            // Guardar datos en sesion
            $_SESSION['id_usuario'] = $user_data['id_usuario'];
            $_SESSION['nombre_usuario'] = $user_data['nombre_usuario'];
            $_SESSION['correo'] = $user_data['correo'];
            $_SESSION['clasificacion'] = $user_data['clasificacion'];
            $_SESSION['foto_perfil'] = $user_data['foto_perfil'];

            // Guardar datos adicionales si el usuario tiene registro como cliente
            if (!empty($user_data['id_cliente'])) {
                $_SESSION['id_cliente'] = $user_data['id_cliente'];
                $_SESSION['nombre_cliente'] = $user_data['nombre_cliente'] ?? '';
                $_SESSION['direccion'] = $user_data['direccion'] ?? '';
                $_SESSION['datos_contacto'] = $user_data['datos_contacto'] ?? '';
                $_SESSION['fecha_nacimiento'] = $user_data['fecha_nacimiento'] ?? '';
                $_SESSION['cedula'] = $user_data['cedula'] ?? '';
            }

            // Redirigir segun la clasificación del usuario
            if ($user_data['clasificacion'] === 'Administrador') {
                header("Location: ../admin/loginAdmin.php");
            } else {
                header("Location: ../userProfile.php");
            }
            exit();
        } else {
            header("Location: ../login.php?error=credenciales");
            exit();
        }
    } else {
        header("Location: ../login.php?error=correo_no_verificado");
        exit();
    }

    $stmt->close();
}
$conn->close();
