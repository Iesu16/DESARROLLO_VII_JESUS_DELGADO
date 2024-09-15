<?php
require_once 'Gerente.php';
require_once 'Desarrollador.php';
require_once 'Empresa.php';

$empresa = new Empresa();

$gerente = new Gerente("Ana Pérez", 1, 3500, "Ventas");
$gerente->asignarBono(1000);
$desarrollador = new Desarrollador("Juan García", 2, 2000, "PHP", "Senior");

$empresa->agregarEmpleado($gerente);
$empresa->agregarEmpleado($desarrollador);

echo "Listado de empleados:<br>";
$empresa->listarEmpleados();

echo "<br>Nómina total: $" . $empresa->calcularNominaTotal() . "<br>";

echo "<br>Evaluaciones de desempeño:<br>";
$empresa->realizarEvaluaciones();
?>
