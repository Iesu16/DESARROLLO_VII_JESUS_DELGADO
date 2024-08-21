<?php
echo "Patrón de triángulo rectángulo:<br><br>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

echo "<br>";

echo "Números impares del 1 al 20:<br>";
$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 != 0) {
        echo $numero . " ";
    }
    $numero++;
}

echo "<br><br>";

// 3. Contador regresivo desde 10 hasta 1 con un bucle do-while, saltando el número 5
echo "Contador regresivo desde 10 hasta 1 (sin el número 5):<br>";
$contador = 10;
do {
    if ($contador == 5) {
        $contador--;
        continue;
    }
    echo $contador . " ";
    $contador--;
} while ($contador >= 1);

echo "<br>";
?>
