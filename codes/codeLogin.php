<?php
include '../database/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);

    $stmt = $conn->prepare("SELECT Usuarios.*, Clientes.* FROM Usuarios 
                            LEFT JOIN Clientes ON Usuarios.id_usuario = Clientes.id_usuario 
                            WHERE Usuarios.nombre_usuario = ? AND Usuarios.correo_verificado = 1");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user_data = $result->fetch_assoc();

        if (password_verify($contraseña, $user_data['contraseña'])) {
            $_SESSION['id_usuario'] = $user_data['id_usuario'];
            $_SESSION['nombre_usuario'] = $user_data['nombre_usuario'];
            $_SESSION['correo'] = $user_data['correo'];
            $_SESSION['clasificacion'] = $user_data['clasificacion'];
            $_SESSION['direccion'] = $user_data['direccion'];
            $_SESSION['datos_contacto'] = $user_data['datos_contacto'];
            $_SESSION['fecha_nacimiento'] = $user_data['fecha_nacimiento'];
            $_SESSION['cedula'] = $user_data['cedula'];
            $_SESSION['foto_perfil'] = $user_data['foto_perfil'];

            header("Location: ../userProfile.php");
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
