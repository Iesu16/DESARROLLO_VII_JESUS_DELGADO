<?php
require_once 'Estudiante.php';
require_once 'SistemaGestionEstudiantes.php';

$sistema = new SistemaGestionEstudiantes();

for ($i = 1; $i <= 10; $i++) {
    $estudiante = new Estudiante($i, "Estudiante $i", 18 + $i, "Carrera " . ($i % 3));
    $estudiante->agregarMateria("Materia A", rand(5, 10));
    $estudiante->agregarMateria("Materia B", rand(5, 10));
    $sistema->agregarEstudiante($estudiante);
}

echo "<h1>Estudiantes:</h1>";
foreach ($sistema->listarEstudiantes() as $est) {
    echo $est . "<br>";
}

echo "<h1>Promedio General:</h1>";
echo number_format($sistema->calcularPromedioGeneral(), 2) . "<br>";

echo "<h1>Mejor Estudiante:</h1>";
$mejorEstudiante = $sistema->obtenerMejorEstudiante();
if ($mejorEstudiante) {
    echo $mejorEstudiante . "<br>";
}

echo "<h1>Ranking de Estudiantes:</h1>";
foreach ($sistema->generarRanking() as $rank) {
    echo $rank . "<br>";
}

echo "<h1>Reporte de Rendimiento:</h1>";
$reporte = $sistema->generarReporteRendimiento();
foreach ($reporte as $materia => $datos) {
    echo "$materia - Promedio: " . number_format($datos['promedio'], 2) . ", Max: " . $datos['max'] . ", Min: " . $datos['min'] . "<br>";
}

echo "<h1>Estadísticas por Carrera:</h1>";
$estadisticas = $sistema->generarEstadisticasPorCarrera();
foreach ($estadisticas as $carrera => $data) {
    echo "Carrera: $carrera - Promedio General: " . number_format($data['promedioGeneral'], 2) . "<br>";
    if ($data['mejorEstudiante']) {
        echo "  Mejor Estudiante: " . $data['mejorEstudiante'] . "<br>";
    }
}

?>
