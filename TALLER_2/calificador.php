<?php
$calificacion = 70; 

if ($calificacion >= 90 && $calificacion <= 100) {
    $letra = 'A';
} elseif ($calificacion >= 80 && $calificacion < 90) {
    $letra = 'B';
} elseif ($calificacion >= 70 && $calificacion < 80) {
    $letra = 'C';
} elseif ($calificacion >= 60 && $calificacion < 70) {
    $letra = 'D';
} else {
    $letra = 'F';
}

echo "Tu calificación es $letra.<br><br>";

$estado = ($letra != 'F') ? "Aprobado" : "Reprobado";
echo "$estado<br>";

switch ($letra) {
    case 'A':
        echo "Excelente trabajo";
        break;
    case 'B':
        echo "Buen trabajo";
        break;
    case 'C':
        echo "Trabajo aceptable";
        break;
    case 'D':
        echo "Necesitas mejorar";
        break;
    case 'F':
        echo "Debes esforzarte más";
        break;
    default:
        echo "Calificación no válida";
        break;
}

?>
