<?php
require 'configsesion.php';

if (isset($_GET['id'])) {
    $id = sanitize($_GET['id']);

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad']++;
    } else {
        $_SESSION['carrito'][$id] = [
            'nombre' => "Producto $id", 
            'precio' => 10.00 * $id, 
            'cantidad' => 1
        ];
    }

    header('Location: productos.php');
    exit();
}
?>
