
<?php
// Ejemplo básico de strpos()
$texto = "Hola, mundo!";
$posicion = strpos($texto, "mundo");
echo "La palabra 'mundo' comienza en la posición: $posicion";

// Búsqueda que no encuentra resultados
$busqueda = strpos($texto, "PHP");
if ($busqueda === false) {
    echo "<br>La palabra 'PHP' no se encontró en el texto.";
}

// Ejercicio: Verificar si un email es válido (contiene @)
function esEmailValido($email) {
    return strpos($email, "@") !== false;
}

$email1 = "usuario@example.com";
$email2 = "usuarioexample.com";
echo "<br>¿'$email1' es un email válido? " . (esEmailValido($email1) ? "Sí" : "No") . "";
echo "<br>¿'$email2' es un email válido? " . (esEmailValido($email2) ? "Sí" : "No") . "";

// Bonus: Encontrar todas las ocurrencias de una letra
function encontrarTodasLasOcurrencias($texto, $letra) {
    $posiciones = [];
    $posicion = 0;
    while (($posicion = strpos($texto, $letra, $posicion)) !== false) {
        $posiciones[] = $posicion;
        $posicion++;
    }
    return $posiciones;
}

$frase = "La programación es divertida y desafiante";
$letra = "a";
$ocurrencias = encontrarTodasLasOcurrencias($frase, $letra);
echo "<br>Posiciones de la letra '$letra' en '$frase': " . implode(", ", $ocurrencias) . "";

// Extra: Extraer el nombre de usuario de una dirección de correo electrónico
function extraerNombreUsuario($email) {
    $posicionArroba = strpos($email, "@");
    if ($posicionArroba === false) {
        return false;
    }
    return substr($email, 0, $posicionArroba);
}

$email = "usuario@example.com";
$nombreUsuario = extraerNombreUsuario($email);
echo "<br>Nombre de usuario extraído de '$email': " . ($nombreUsuario !== false ? $nombreUsuario : "Email no válido") . "";

// Desafío: Censurar palabras en un texto
function censurarPalabras($texto, $palabrasCensuradas) {
    foreach ($palabrasCensuradas as $palabra) {
        $longitud = strlen($palabra);
        $censura = str_repeat("*", $longitud);
        $posicion = 0;
        while (($posicion = stripos($texto, $palabra, $posicion)) !== false) {
            $texto = substr_replace($texto, $censura, $posicion, $longitud);
            $posicion += $longitud;
        }
    }
    return $texto;
}

$textoOriginal = "<br>Este es un texto con algunas palabras que deben ser censuradas.";
$palabrasCensuradas = ["texto", "palabras", "censuradas"];
$textoCensurado = censurarPalabras($textoOriginal, $palabrasCensuradas);
echo "<br>Texto original: $textoOriginal";
echo "<br>Texto censurado: $textoCensurado";

// Ejemplo adicional: Verificar si una URL es segura (comienza con https)
function esUrlSegura($url) {
    return strpos($url, "https://") === 0;
}

$url1 = "https://www.example.com";
$url2 = "http://www.example.com";
echo "<br>¿'$url1' es una URL segura? " . (esUrlSegura($url1) ? "Sí" : "No") . "";
echo "<br>¿'$url2' es una URL segura? " . (esUrlSegura($url2) ? "Sí" : "No") . "";
?>
      
