<?php
include 'dattabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['usuario'];
    $password = $_POST['contraseña'];

    // Prevenir inyecciones SQL
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Consulta segura usando sentencias preparadas
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['contraseña'])) {
        // Establecer una cookie de sesión
        setcookie("usuario", $username, time() + (86400 * 30), "/"); // 86400 = 1 día


        // inicia sesion y manda a index
        header("Location: index.php");
        exit();
    } else {
        // Fallo en el inicio de sesión
        echo "Usuario o contraseña incorrectos";
    }

    $stmt->close();
}
$conn->close();
?>