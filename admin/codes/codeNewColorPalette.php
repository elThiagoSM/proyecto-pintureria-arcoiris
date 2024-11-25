<?php
include '../database/database.php'; // Conexin a la base de datos

// Procesar el formulario de nueva paleta de colores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $codigo_color = $_POST['codigo_color'] ?? '';
  $nombre_color = $_POST['nombre_color'] ?? '';
  $tintes_utilizados = $_POST['tintes_utilizados'] ?? '';

  $query = "INSERT INTO paletacolor (codigo_de_color, nombre_color, tintes_utilizados) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sss", $codigo_color, $nombre_color, $tintes_utilizados);

  if ($stmt->execute()) {
    echo "<script>
                alert('Paleta de color agregada exitosamente.');
                window.location.href = '../colorPalette.php';
              </script>";
  } else {
    echo "<script>
                alert('Error al agregar la paleta de colores: " . $stmt->error . "');
                window.location.href = '../colorPalette.php';
              </script>";
  }
  exit();
}
