<?php
$paginaActual = 'inicio'; 
require_once 'funciones/utilidades_texto.php';

$tituloPagina = obtenerTituloPagina($paginaActual);
#include 'plantillas/encabezado.php';
?>

<h2>Conteo de palabras</h2>
<p>Este es el contenido específico de la página de inicio.</p>


<?php
#include 'plantillas/pie_pagina.php';
$cadena1 = 'prueba de la prueba';
$frase1 = contar_palabras($cadena1);

echo  'La frase: ' . $cadena1 . '<br>';

print_r('tiene ' . $frase1 . ' palabras<br>');
?>