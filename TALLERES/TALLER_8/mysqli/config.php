<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '12345';
$base_datos = 'biblioteca';

$conn = mysqli_connect($host, $usuario, $contraseña, $base_datos);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
