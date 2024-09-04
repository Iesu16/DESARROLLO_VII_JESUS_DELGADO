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
$cadena2 = 'VocabularIo';
$frase2 = contar_vocales($cadena2);

echo  'La palabra: ' . $cadena2 . '<br>';

print_r('tiene ' . $frase2 . ' vocales<br>');
?>

<h2>Palabra invertida</h2>


<?php
#include 'plantillas/pie_pagina.php';
$cadena3 = 'Esta es una prueba';
$frase3 = invertir_palabras($cadena3);

echo  'La frase: ' . $cadena3 . '<br>';

print_r('Al revez es: ' . $frase3 );
?>