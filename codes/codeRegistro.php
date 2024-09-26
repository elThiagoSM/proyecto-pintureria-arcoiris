<?php
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $correo = $_POST['correo'];

    // Prevenir inyecciones SQL
    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);
    $correo = mysqli_real_escape_string($conn, $correo);

    // Comprobar si el nombre de usuario o el correo ya existen
    $checkUserStmt = $conn->prepare("SELECT * FROM Usuarios WHERE nombre_usuario = ? OR correo = ?");
    $checkUserStmt->bind_param("ss", $nombre_usuario, $correo);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        echo "El nombre de usuario o correo ya están registrados.";
    } else {
        // Hash de la contraseña
        $hashed_password = password_hash($contraseña, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos con clasificación predeterminada 'Cliente'
        $stmt = $conn->prepare("INSERT INTO Usuarios (nombre_usuario, contraseña, correo, clasificación) VALUES (?, ?, ?, 'Cliente')");
        $stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo);

        if ($stmt->execute()) {
            // Registro exitoso, redirigir al login
            header("Location: ../login.php?registro=exitoso");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkUserStmt->close();
}
$conn->close();
