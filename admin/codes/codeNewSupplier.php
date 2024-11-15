<?php
include '../database/database.php'; // Conexión a la base de datos

// Obtener y validar los datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$correo = $conn->real_escape_string($_POST['correo']);
$direccion = $conn->real_escape_string($_POST['direccion']);

// Insertar datos en la tabla Proveedores
$sql_proveedor = "INSERT INTO Proveedores (nombre, telefono, correo, direccion)
                  VALUES ('$nombre', '$telefono', '$correo', '$direccion')";

if ($conn->query($sql_proveedor) === TRUE) {
  // Mostrar mensaje de éxito en un alert y redirigir
  echo "<script>
            alert('Proveedor agregado exitosamente.');
            window.location.href = '../suppliers.php';
          </script>";
} else {
  // Mostrar mensaje de error en un alert y redirigir
  $error = $conn->error;
  echo "<script>
            alert('Error al insertar proveedor: $error');
            window.location.href = '../suppliers.php';
          </script>";
}

// Cerrar la conexión
$conn->close();
