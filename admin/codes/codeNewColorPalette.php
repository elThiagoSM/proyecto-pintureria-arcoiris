<?php
include '../database/database.php'; // Conexión a la base de datos

// Procesar el formulario de nueva paleta de colores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_color = $_POST['codigo_color'] ?? '';
    $nombre_color = $_POST['nombre_color'] ?? '';
    $tintes_utilizados = $_POST['tintes_utilizados'] ?? '';

    $query = "INSERT INTO PaletaColor (codigo_de_color, nombre_color, tintes_utilizados) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $codigo_color, $nombre_color, $tintes_utilizados);

    if ($stmt->execute()) {
        header("Location: colorPalette.php");
        exit();
    } else {
        $error = "Error al agregar la paleta de colores";
        header("Location: newColorPalette.php?error=" . urlencode($error));
        exit();
    }
}
