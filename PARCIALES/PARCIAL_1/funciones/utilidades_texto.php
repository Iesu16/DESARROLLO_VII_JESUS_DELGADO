<?php
function obtenerTituloPagina($pagina) {
    $titulos = [
        'inicio' => 'Página de Inicio'
    ];
    return isset($titulos[$pagina]) ? $titulos[$pagina] : 'Página Desconocida';
}

function contar_palabras($texto) {
}

function contar_vocales($texto) {  
}

function invertir_palabras($texto) {
}

?>