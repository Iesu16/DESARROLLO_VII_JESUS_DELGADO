<?php
function calcular_descuento($total_compra) {
    if ($total_compra < 100) {
        $descuento = 0;
    } elseif ($total_compra <= 500) {
        $descuento = $total_compra * 0.05;
    } elseif ($total_compra <= 1000) {
        $descuento = $total_compra * 0.10;
    } else {
        $descuento = $total_compra * 0.15;
    }
    
    return $descuento;
}


?>