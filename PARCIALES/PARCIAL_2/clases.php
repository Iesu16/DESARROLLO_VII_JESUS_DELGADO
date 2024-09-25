<?php
// Archivo: clases.php
interface Detalle {
    public function obtenerDetallesEspecificos(): string;
}


class Tarea implements Detalle {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    // Implementación de la interfaz Detalles
    public function obtenerDetallesEspecificos(): string {
        return "Tarea general sin detalles específicos.";
    }

    // Getters para obtener estado y prioridad
    public function getEstado() {
        return $this->estado;
    }

    public function getPrioridad() {
        return $this->prioridad;
    }
}


class GestorTareas {
    private $tareas = [];

    public function cargarTareas() {
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);

        foreach ($data as $tareaData) {
            switch ($tareaData['tipo']) {
                case 'desarrollo':
                    $tarea = new TareaDesarrollo($tareaData, $tareaData['lenguajeProgramacion']);
                    break;
                case 'diseno':
                    $tarea = new TareaDiseno($tareaData, $tareaData['herramientaDiseno']);
                    break;
                case 'testing':
                    $tarea = new TareaTesting($tareaData, $tareaData['tipoTest']);
                    break;
                default:
                    $tarea = new Tarea($tareaData); // En caso de tipo desconocido
                    break;
            }
            $this->tareas[] = $tarea;
        }

        return $this->tareas;
    }
}





class TareaDesarrollo extends Tarea {
    public $lenguajeProgramacion;

    public function __construct($datos, $lenguajeProgramacion) {
        parent::__construct($datos);
        $this->lenguajeProgramacion = $lenguajeProgramacion;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Lenguaje de Programación: " . $this->lenguajeProgramacion;
    }
}

class TareaDiseno extends Tarea {
    public $herramientaDiseno;

    public function __construct($datos, $herramientaDiseno) {
        parent::__construct($datos);
        $this->herramientaDiseno = $herramientaDiseno;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Herramienta de Diseño: " . $this->herramientaDiseno;
    }
}

class TareaTesting extends Tarea {
    public $tipoTest;

    public function __construct($datos, $tipoTest) {
        parent::__construct($datos);
        $this->tipoTest = $tipoTest;
    }

    public function obtenerDetallesEspecificos(): string {
        return "Tipo de Test: " . $this->tipoTest;
    }
}


// Implementar:
// 1. La interfaz Detalle
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea

