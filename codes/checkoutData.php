<?php
// Verificar si las cookies están establecidas y definir valores predeterminados
$nombre = isset($_COOKIE['nombre_usuario']) ? $_COOKIE['nombre_usuario'] : '';
$correo = isset($_COOKIE['correo']) ? $_COOKIE['correo'] : '';
$telefono = isset($_COOKIE['datos_contacto']) ? $_COOKIE['datos_contacto'] : '';
$documento = isset($_COOKIE['cedula']) ? $_COOKIE['cedula'] : '';

// Generar los valores de los campos usando PHP para que se llenen automáticamente si hay cookies
echo "<input type='text' name='nombre' value='$nombre' placeholder='Nombre y apellido' disabled><br>";
echo "<input type='email' name='correo' value='$correo' placeholder='Dirección de email' disabled><br>";
echo "<input type='tel' name='telefono' value='$telefono' placeholder='Número de teléfono' disabled><br>";
echo "<input type='text' name='documento' value='$documento' placeholder='Número Documento' disabled>";
