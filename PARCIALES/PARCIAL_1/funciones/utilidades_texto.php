<?php
function obtenerTituloPagina($pagina) {
    $titulos = [
        'inicio' => 'Página de Inicio'
    ];
    return isset($titulos[$pagina]) ? $titulos[$pagina] : 'Página Desconocida';
}

function contar_palabras($texto) {
    $arraycontarp = explode(" ", $texto);
    $arraycontarn = count($arraycontarp);
    return $arraycontarn;
    
}

function contar_vocales($texto) {
    $vocales = ['a', 'e', 'i', 'o', 'u'];
    $texto = strtolower($texto);
    $contador = 0;

    for ($i = 0; $i < strlen($texto); $i++) {
        if (in_array($texto[$i], $vocales)) {
            $contador++;
        }
    }

    return $contador;
}


function invertir_palabras($texto) {
    $palabras = explode(' ', $texto);
    $palabras_invertidas = array_reverse($palabras);
    $texto_invertido = implode(' ', $palabras_invertidas);
    
    return $texto_invertido;
}


?>