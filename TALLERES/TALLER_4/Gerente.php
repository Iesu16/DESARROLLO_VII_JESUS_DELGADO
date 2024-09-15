<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono;

    public function __construct($nombre, $idEmpleado, $salarioBase, $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
        $this->bono = 0;
    }

    public function getDepartamento() {
        return $this->departamento;
    }

    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    public function asignarBono($monto) {
        $this->bono = $monto;
    }

    public function calcularSalarioTotal() {
        return $this->getSalarioBase() + $this->bono;
    }
    

    public function evaluarDesempenio() {
      
        return "Evaluación del desempeño del gerente: excelente.";
    }
}
?>
