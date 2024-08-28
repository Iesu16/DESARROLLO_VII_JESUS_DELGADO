
<?php
// Ejemplo de uso de is_array()
$frutas = ["Manzana", "Naranja", "Plátano"];
$nombre = "Juan";
$edad = 25;

echo "<br><br>¿$frutas es un array? " . (is_array($frutas) ? "Sí" : "No") . "";
echo "¿$nombre es un array? " . (is_array($nombre) ? "Sí" : "No") . "";
echo "¿$edad es un array? " . (is_array($edad) ? "Sí" : "No") . "";

// Ejercicio: Crea tres variables: una que sea un array, otra que sea un string y otra que sea un número
// Usa is_array() para verificar cada una de ellas
$miArray = ["Palabra", "string", "palabra"]; // Reemplaza esto con tu propio array
$miString = "cadena"; // Reemplaza esto con tu propio string
$miNumero = 0; // Reemplaza esto con tu propio número

echo "<br><br>Resultados del ejercicio:";
echo "<br><br>¿$miArray es un array? " . (is_array($miArray) ? "Sí" : "No") . "";
echo "¿$miString es un array? " . (is_array($miString) ? "Sí" : "No") . "";
echo "¿$miNumero es un array? " . (is_array($miNumero) ? "Sí" : "No") . "";

// Bonus: Usa is_array() en una función que acepte cualquier tipo de dato
function procesarDato($dato) {
    if (is_array($dato)) {
        echo "<br><br>El dato es un array. Contenido:";
        print_r($dato);
    } else {
        echo "<br><br>El dato no es un array. Valor: $dato";
    }
}

echo "<br><br>Pruebas de la función procesarDato():";
procesarDato([1, 2, 3]);
procesarDato("Hola mundo");
procesarDato(42);
?>
      
