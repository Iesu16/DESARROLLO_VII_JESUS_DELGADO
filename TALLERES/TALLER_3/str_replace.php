<?php
// Ejemplo de uso de str_replace()
$frase = "El gato negro saltó sobre el perro negro";
$fraseModificada = str_replace("negro", "blanco", $frase);

echo "Frase original: $frase
";
echo "Frase modificada: $fraseModificada
";

// Ejercicio: Crea una variable con una frase que contenga al menos tres veces la palabra "PHP"
// y usa str_replace() para cambiar "PHP" por "JavaScript"
$miFrase = "<br>Un pollo de montaña no es un ave    <br>"; // Reemplaza esto con tu frase
$buscar = ["pollo", "no"];
$reemplazar = ["aguila", "si"];
$miFraseModificada = str_replace($buscar, $reemplazar, $miFrase);

echo "<br>Mi frase original: $miFrase
";
echo "Mi frase modificada: $miFraseModificada
";

// Bonus: Usa str_replace() para reemplazar múltiples palabras a la vez
$texto = "Manzanas y naranjas son frutas. Me gustan las manzanas y las naranjas.";
$buscar = ["Manzanas", "naranjas"];
$reemplazar = ["Peras", "uvas"];
$textoModificado = str_replace($buscar, $reemplazar, $texto);

echo "
Texto original: $texto
";
echo "Texto modificado: $textoModificado
";
?>
          
