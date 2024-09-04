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

// Ejemplo de uso:
$texto = "Hola Mundo";
echo contar_vocales($texto); // Salida: 4


function invertir_palabras($texto) {
}

?>