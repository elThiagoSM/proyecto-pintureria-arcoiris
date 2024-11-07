<?php
// Configuración de la base de datos
$servername = "localhost"; // Nombre del servidor
$username = "root"; // Usuario de la BD
$password = ""; // Contraseña de la BD
$dbname = "bd_pinturaria_arcoiris"; // Nombre de la BD

// Conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexion
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
