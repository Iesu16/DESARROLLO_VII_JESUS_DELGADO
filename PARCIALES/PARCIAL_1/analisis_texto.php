<?php
$paginaActual = 'inicio'; 
require_once 'funciones/utilidades_texto.php';

$tituloPagina = obtenerTituloPagina($paginaActual);
#include 'plantillas/encabezado.php';
?>

<h2>Conteo de palabras</h2>


<?php
#include 'plantillas/pie_pagina.php';
$cadena1 = 'prueba de la prueba';
$frase1 = contar_palabras($cadena1);

echo  'La frase: ' . $cadena1 . '<br>';

print_r('tiene ' . $frase1 . ' palabras<br>');
?>

<h2>Conteo de vocales</h2>


<?php
#include 'plantillas/pie_pagina.php';
$cadena2 = 'Vocabulario';
$frase2 = contar_vocales($cadena2);

echo  'La palabra: ' . $cadena2 . '<br>';

print_r('tiene ' . $frase2 . ' vocales<br>');
?>