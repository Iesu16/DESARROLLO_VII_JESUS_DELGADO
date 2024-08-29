
<?php
// Ejemplo básico de trim()
$textoConEspacios = "   Hola, mundo!   ";
$textoLimpio = trim($textoConEspacios);
echo "Texto original: '$textoConEspacios'";
echo "<br><br>Texto limpio: '$textoLimpio'";

// Ejemplo con caracteres específicos
$textoConCaracteres = "...Hola, mundo!...";
$textoSinPuntos = trim($textoConCaracteres, ".");
echo "<br><br>Texto con puntos: '$textoConCaracteres'";
echo "<br><br>Texto sin puntos: '$textoSinPuntos'";

// Ejercicio: Limpia el siguiente texto eliminando espacios y guiones bajos al inicio y al final
$textoParaLimpiar = "___   Mi nombre es Juan   ___";
$textoLimpiado = trim($textoParaLimpiar, " _");
echo "<br><br>Texto original para limpiar: '$textoParaLimpiar'";
echo "<br><br>Texto limpiado: '$textoLimpiado'";

// Bonus: Uso de ltrim() y rtrim()
$textoIzquierda = "   Izquierda  ";
$textoDerecha = "  Derecha   ";
echo "<br><br>Trim izquierdo: '" . ltrim($textoIzquierda) . "'";
echo "Trim derecho: '" . rtrim($textoDerecha) . "'";

// Extra: Limpieza de un array de strings
$arrayConEspacios = [
    "   Primer elemento   ",
    "  Segundo elemento  ",
    " Tercer elemento "
];
$arrayLimpio = array_map('trim', $arrayConEspacios);
echo "
Array original:";
print_r($arrayConEspacios);
echo "Array limpio:";
print_r($arrayLimpio);

// Desafío: Crea una función que limpie una cadena de caracteres no deseados al inicio y al final
function limpiarCadena($cadena, $caracteresNoDeseados = " 	

") {
    return trim($cadena, $caracteresNoDeseados);
}

$cadenaSucia = "Hola, esto es una prueba!@#@";
$cadenaLimpia = limpiarCadena($cadenaSucia, " 	@#");
echo "<br><br>Cadena sucia: '$cadenaSucia'";
echo "<br><br>Cadena limpia: '$cadenaLimpia'";

// Mi practica
$textoOrigen = "!!!Alterado!!!";
$textoSimple = trim($textoOrigen, "!");
echo "<br><br>Texto original: '$textoOrigen'";
echo "<br><br>Texto limpio: '$textoSimple'";

?>
      
