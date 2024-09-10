<?php
// Ejemplo de uso de explode()
$frase = "Manzana,Naranja,Plátano,Uva<br>";
$frutas = explode(",", $frase);

echo "Frase original: $frase";
echo "Array de frutas:";
print_r($frutas);

// Ejercicio: Crea una variable con una lista de tus 5 películas favoritas separadas por guiones (-)
// y usa explode() para convertirla en un array
$misPeliculas = "Tron, Up, Nope, Us, 1812"; // Reemplaza esto con tu lista de películas
$arrayPeliculas = explode(", ", $misPeliculas);

echo "<br> <br>Mis películas favoritas:";
print_r($arrayPeliculas);

// Bonus: Usa explode() con un límite
$texto = "Uno,Dos,Tres,Cuatro,Cinco";
$array = explode(",", $texto, 3);

echo "<br> <br>Texto original: $texto";
echo "Array con límite:";
print_r($array);
?>
      
