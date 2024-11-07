<?php
include '../database/database.php'; // Conexion a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $datos_contacto = $_POST['datos_contacto'];

    // Prevenir inyecciones SQL
    $nombre_usuario = mysqli_real_escape_string($conn, $nombre_usuario);
    $contraseña = mysqli_real_escape_string($conn, $contraseña);
    $correo = mysqli_real_escape_string($conn, $correo);
    $cedula = mysqli_real_escape_string($conn, $cedula);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $fecha_nacimiento);
    $direccion = mysqli_real_escape_string($conn, $direccion);
    $datos_contacto = mysqli_real_escape_string($conn, $datos_contacto);

    // Comprobar si el nombre de usuario, el correo o la cedula ya existen
    $checkUserStmt = $conn->prepare("SELECT * FROM Usuarios WHERE nombre_usuario = ? OR correo = ?");
    $checkUserStmt->bind_param("ss", $nombre_usuario, $correo);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        echo "El nombre de usuario o correo ya están registrados.";
    } else {
        // Hash de la contraseña
        $hashed_password = password_hash($contraseña, PASSWORD_BCRYPT); // Solo hacer el hash una vez

        // Insertar el nuevo usuario en la base de datos con clasificacion predeterminada 'Cliente'
        $stmt = $conn->prepare("INSERT INTO Usuarios (nombre_usuario, contraseña, correo, clasificacion) VALUES (?, ?, ?, 'Cliente')");
        $stmt->bind_param("sss", $nombre_usuario, $hashed_password, $correo);

        if ($stmt->execute()) {
            // Obtener el ID del usuario recien creado
            $id_usuario = $stmt->insert_id;

            // Insertar datos en la tabla Clientes
            $stmt_cliente = $conn->prepare("INSERT INTO Clientes (nombre_cliente, correo, direccion, datos_contacto, fecha_nacimiento, cedula, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_cliente->bind_param("ssssssi", $nombre_usuario, $correo, $direccion, $datos_contacto, $fecha_nacimiento, $cedula, $id_usuario);
            $stmt_cliente->execute();
            $stmt_cliente->close();

            // Registro exitoso: redirigir al login
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
