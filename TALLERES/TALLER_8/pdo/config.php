<?php
$host = 'localhost';
$usuario = 'root';
$contraseña = '';
$base_datos = 'biblioteca';

try {
    $conn = new PDO("mysql:host=$host;dbname=$base_datos;charset=utf8", $usuario, $contraseña);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>
