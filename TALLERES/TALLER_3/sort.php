<?php
// Ejemplo básico de sort()
$numeros = [5, 2, 8, 1, 9];
echo "<br>Array original: " . implode(", ", $numeros) . "";
sort($numeros);
echo "<br>Array ordenado: " . implode(", ", $numeros) . "";

// Ordenar strings
$frutas = ["naranja", "manzana", "plátano", "uva"];
echo "<br>Frutas originales: " . implode(", ", $frutas) . "";
sort($frutas);
echo "<br>Frutas ordenadas: " . implode(", ", $frutas) . "";

// Ejercicio: Ordenar calificaciones de estudiantes
$calificaciones = [
    "Juan" => 85,
    "María" => 92,
    "Carlos" => 78,
    "Ana" => 95
];
echo "<br>Calificaciones originales:";
print_r($calificaciones);

asort($calificaciones);  // Ordena por valor manteniendo la asociación de índices
echo "<br>Calificaciones ordenadas por nota:";
print_r($calificaciones);

ksort($calificaciones);  // Ordena por clave (nombre del estudiante)
echo "<br>Calificaciones ordenadas por nombre:";
print_r($calificaciones);

// Bonus: Ordenar en orden descendente
$numeros = [5, 2, 8, 1, 9];
rsort($numeros);
echo "<br>Números en orden descendente: " . implode(", ", $numeros) . "";

// Extra: Ordenar array multidimensional
$estudiantes = [
    ["nombre" => "Juan", "edad" => 20, "promedio" => 8.5],
    ["nombre" => "María", "edad" => 22, "promedio" => 9.2],
    ["nombre" => "Carlos", "edad" => 19, "promedio" => 7.8],
    ["nombre" => "Ana", "edad" => 21, "promedio" => 9.5]
];

// Ordenar por promedio
usort($estudiantes, function($a, $b) {
    return $b['promedio'] <=> $a['promedio'];
});

echo "<br>Estudiantes ordenados por promedio (descendente):";
foreach ($estudiantes as $estudiante) {
    echo "{$estudiante['nombre']}: {$estudiante['promedio']}";
}

// Desafío: Implementar ordenamiento personalizado
function ordenarPorLongitud($a, $b) {
    return strlen($b) - strlen($a);
}

$palabras = ["PHP", "JavaScript", "Python", "Java", "C++", "Ruby"];
usort($palabras, 'ordenarPorLongitud');
echo "<br>Palabras ordenadas por longitud (descendente):";
print_r($palabras);

// Ejemplo adicional: Ordenar preservando claves
$datos = [
    "z" => "Último",
    "a" => "Primero",
    "m" => "Medio"
];

ksort($datos);  // Ordena por clave
echo "<br>Datos ordenados por clave:";
print_r($datos);

arsort($datos);  // Ordena por valor en orden descendente
echo "Datos ordenados por valor (descendente):";
print_r($datos);
?>
      
