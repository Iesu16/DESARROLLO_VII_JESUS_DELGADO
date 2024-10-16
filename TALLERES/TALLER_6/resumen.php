<?php
$archivoDatos = 'datos.json';

// Verifica si hay registros en el archivo
if (file_exists($archivoDatos)) {
    $registros = json_decode(file_get_contents($archivoDatos), true);

    echo "<h2>Resumen de Registros</h2>";
    foreach ($registros as $registro) {
        echo "<div>";
        foreach ($registro as $campo => $valor) {
            if ($campo === 'intereses') {
                echo "$campo: " . implode(", ", $valor) . "<br>";
            } elseif ($campo === 'foto_perfil') {
                echo "$campo: <img src='$valor' width='100'><br>";
            } else {
                echo "$campo: $valor<br>";
            }
        }
        echo "</div><hr>";
    }
} else {
    echo "No hay registros.";
}
?>
