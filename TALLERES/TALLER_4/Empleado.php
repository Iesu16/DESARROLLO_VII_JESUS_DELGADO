<?php

    class Empleado  {
    private $nombre;
    private $idEmpleado;
    private $salarioBase;

    public function __construct($nombre, $idEmpleado, $salarioBase) {
        $this->setNombre($nombre);
        $this->setIdEmpleado($idEmpleado);
        $this->setSalarioBase($salarioBase);
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = trim($nombre);
    }

    public function getIdEmpleado() {
        return $this->autor;
    }

    public function setIdEmpleado($idEmpleado) {
        $this->autor = trim($idEmpleado);
    }

    public function getSalarioBase() {
        return $this->salarioBase;
    }

    public function setSalarioBase($salario) {
        $this->salarioBase = intval($salario);
    }
}
?>
                                         