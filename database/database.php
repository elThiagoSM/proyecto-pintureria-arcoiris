<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "cliente_us";
$password = "contraseña_segura";
$dbname = "bd_pinturaria_arcoiris";

// Conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexion
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
