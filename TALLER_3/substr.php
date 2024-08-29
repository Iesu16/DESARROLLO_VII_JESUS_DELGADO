
<?php
// Ejemplo básico de substr()
$texto = "Hola Mundo<br>";
$extracto1 = substr($texto, 0, 4);  // Extrae desde la posición 0, 4 caracteres
$extracto2 = substr($texto, 5);     // Extrae desde la posición 5 hasta el final

echo "Texto original: $texto";
echo "<br>Extracto 1: $extracto1";
echo "<br>Extracto 2: $extracto2";

// Ejemplo con índices negativos
$palabra = "Programación";
$ultimasPalabras = substr($palabra, -4);  // Extrae los últimos 4 caracteres
echo "<br>Palabra original: $palabra<br>";
echo "Últimas letras: $ultimasPalabras<br>";

// Ejercicio: Extrae el nombre y apellido de una cadena
$nombreCompleto = "Juan Pérez Rodríguez";
$nombre = substr($nombreCompleto, 0, strpos($nombreCompleto, " "));
$apellido = substr($nombreCompleto, strrpos($nombreCompleto, " ") + 1);
echo "<br>Nombre completo: $nombreCompleto";
echo "<br>Nombre: $nombre";
echo "<br>Apellido: $apellido";

// Bonus: Ocultar parte de un número de tarjeta de crédito
function ocultarTarjeta($numeroTarjeta) {
    $longitud = strlen($numeroTarjeta);
    $visible = 4;  // Número de dígitos visibles al final
    $oculto = str_repeat("*", $longitud - $visible);
    return $oculto . substr($numeroTarjeta, -$visible);
}

$tarjeta = "1234567890123456";
echo "<br><br>Número de tarjeta original: $tarjeta";
echo "<br><br>Número de tarjeta oculto: " . ocultarTarjeta($tarjeta) . "";

// Extra: Extraer dominio de una dirección de correo electrónico
function extraerDominio($email) {
    return substr($email, strpos($email, "@") + 1);
}

$correo = "usuario@aol.com";
echo "<br><br>Correo electrónico: $correo";
echo "<br>Dominio: " . extraerDominio($correo) . "";

// Desafío: Crear una función que extraiga el texto entre dos delimitadores
function extraerEntre($texto, $inicio, $fin) {
    $inicioPos = strpos($texto, $inicio);
    if ($inicioPos === false) return "";
    
    $inicioPos += strlen($inicio);
    $finPos = strpos($texto, $fin, $inicioPos);
    if ($finPos === false) return "";
    
    return substr($texto, $inicioPos, $finPos - $inicioPos);
}

$textoHTML = "<h1>Título Principal</h1>";
echo "<br><br>Texto HTML: $textoHTML";
echo "Contenido extraído: " . extraerEntre($textoHTML, "<h1>", "</h1>") . "";
?>
      
