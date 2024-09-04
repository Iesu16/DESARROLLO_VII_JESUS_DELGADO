<?php
require_once 'funciones/funciones_tienda.php';
?>

<h2>Tienda</h2>


<?php
$total_compras = 200;
$total_compra = $total_compras;
echo 'Tu compra de ' . $total_compras;  

echo ' tiene un descuento de ' . calcular_descuento($total_compra);
?>