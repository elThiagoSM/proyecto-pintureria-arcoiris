<?php
include '../database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Prevenir inyecciones SQL
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);

    // Comprobar si el nombre de usuario o el correo ya existen
    $checkUserStmt = $conn->prepare("SELECT * FROM usernames WHERE username = ? OR email = ?");
    $checkUserStmt->bind_param("ss", $username, $email);
    $checkUserStmt->execute();
    $result = $checkUserStmt->get_result();

    if ($result->num_rows > 0) {
        echo "El nombre de usuario o correo ya están registrados.";
    } else {
        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usernames (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $email);

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
