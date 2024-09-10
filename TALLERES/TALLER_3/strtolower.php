<?php
// Ejemplo básico de strtolower()
$textoMixto = "HoLa MuNdO";
$textoMinusculas = strtolower($textoMixto);
echo "Texto original: $textoMixto";
echo "<br><br>Texto en minúsculas: $textoMinusculas";

// Ejemplo con una frase
$frase = "PHP Es Un LenGuAjE De PrOgRaMaCiÓn";
$fraseMinusculas = strtolower($frase);
echo "<br><br>Frase original: $frase";
echo "Frase en minúsculas: $fraseMinusculas";

// Ejercicio: Convierte tu nombre completo a minúsculas
$tuNombre = "Jesus Delgado";
$tuNombreMinusculas = strtolower($tuNombre);
echo "<br><br>Tu nombre original: $tuNombre";
echo "Tu nombre en minúsculas: $tuNombreMinusculas";

// Bonus: Comparación de cadenas sin distinción de mayúsculas y minúsculas
function compararSinMayusculas($cadena1, $cadena2) {
    return strtolower($cadena1) === strtolower($cadena2);
}

$palabra1 = "PHP";
$palabra2 = "php";
echo "<br><br>¿'$palabra1' y '$palabra2' son iguales? " . 
    (compararSinMayusculas($palabra1, $palabra2) ? "Sí" : "No") . "";

// Extra: Convertir un array de strings a minúsculas
$lenguajes = ["PHP", "JAVA", "PYTHON", "JavaScript"];
$lenguajesMinusculas = array_map('strtolower', $lenguajes);
echo "<br><br>Lenguajes originales:";
print_r($lenguajes);
echo "Lenguajes en minúsculas:";
print_r($lenguajesMinusculas);

// Desafío: Crea una función que convierta a minúsculas solo la primera letra de cada palabra
function primerLetraMinuscula($frase) {
    $palabras = explode(" ", $frase);
    $palabrasModificadas = array_map(function($palabra) {
        return strtolower(substr($palabra, 0, 1)) . substr($palabra, 1);
    }, $palabras);
    return implode(" ", $palabrasModificadas);
}

$fraseOriginal = "ESTA ES UNA FRASE DE PRUEBA<br>";
$fraseModificada = primerLetraMinuscula($fraseOriginal);
echo "<br><br>Frase original: $fraseOriginal";
echo "Frase modificada: $fraseModificada";




function primerLetraMayuscula($frase) {
    $palabras = explode(" ", $frase);
    $palabrasModificadas = array_map(function($palabra) {
        return substr($palabra, 0, 1) . strtolower(substr($palabra, 1));
    }, $palabras);
    return implode(" ", $palabrasModificadas);
}

$fraseOriginal = "ESTA ES OTRA FRASE DE PRUEBA<br>";
$fraseModificada = primerLetraMayuscula($fraseOriginal);

echo "<br><br>Frase original: $fraseOriginal\n";
echo "Frase modificada: $fraseModificada\n";


?>
      
