<?php
include './database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : 0;

    try {
        if ($accion === 'agregar') {
            $stmt = $conn->prepare("INSERT INTO productos (nombre, categoria, precio) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $nombre, $categoria, $precio);
            $stmt->execute();
            echo "Producto agregado correctamente.";
        } elseif ($accion === 'editar' && !empty($id)) {
            $stmt = $conn->prepare("UPDATE productos SET nombre = ?, categoria = ?, precio = ? WHERE id = ?");
            $stmt->bind_param("ssdi", $nombre, $categoria, $precio, $id);
            $stmt->execute();
            echo "Producto editado correctamente.";
        } elseif ($accion === 'eliminar' && !empty($id)) {
            $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            echo "Producto eliminado correctamente.";
        } else {
            echo "Por favor, ingresa un ID válido para editar o eliminar.";
        }
    } catch (Exception $e) {
        echo 'Error en la operación: ' . $e->getMessage();
    }
}
?>
