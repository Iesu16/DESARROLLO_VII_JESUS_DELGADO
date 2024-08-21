<?php
$nombre_completo = "Jesus Delgado"; 
$edad = 25; 
$correo = "jesus.delgado2@utp.ac.pa"; 
$telefono = "6565-0000";

define("OCUPACION", "Tester");

echo "<p>Nombre completo: " . $nombre_completo . "</p>";
print "<p>Edad: " . $edad . "</p>";
printf("<p>Correo electrónico: %s</p>", $correo);
echo "<p>Teléfono: {$telefono}</p>";
echo "<p>Ocupación: " . OCUPACION . "</p>";

echo "<pre>";
var_dump($nombre_completo);
var_dump($edad);
var_dump($correo);
var_dump($telefono);
var_dump(OCUPACION);
echo "</pre>";
?>
