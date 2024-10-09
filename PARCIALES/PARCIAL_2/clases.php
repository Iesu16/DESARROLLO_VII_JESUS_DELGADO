<?php

interface Detalles {
    public function obtenerDetallesEspecificos(): string;
}

abstract class Entrada implements Detalles {
    public $id;
    public $fecha_creacion;
    public $tipo;
    public $titulo;
    public $descripcion;

    public function __construct(array $datos = []) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

class EntradaUnaColumna extends Entrada {
    public function obtenerDetallesEspecificos(): string {
        return "Titulo: " . $this->titulo;
    }
}

class EntradaDosColumna extends Entrada {
    public $titulo1;

    public $titulo2;
    public $descripcion1;

    public $descripcion2;

    public function obtenerDetallesEspecificos(): string {
        return "Titulo 1: " . $this->titulo1 . ", Titulo 2: " . $this->titulo2;
    }
}

class EntradaTresColumna extends Entrada {
    public $titulo1;

    public $titulo2;
    public $titulo3;
    public $descripcion1;

    public $descripcion2;
    public $descripcion3;

    public function obtenerDetallesEspecificos(): string {
        return "Titulo 1: " . $this->titulo1 . ", Titulo 2: " . $this->titulo2 . ", Titulo 3: " . $this->titulo3;
    }
}

class GestorBlog {
    private $entradas = [];

    public function cargarEntradas() {
        if (file_exists('blog.json')) {
            $json = file_get_contents('blog.json');
            $data = json_decode($json, true);
            foreach ($data as $entradaData) {
                if (isset($entradaData['titulo3'])) {
                    $entrada = new EntradaTresColumna($entradaData);
                } elseif (isset($entradaData['titulo2'])) {
                    $entrada = new EntradaDosColumna($entradaData);
                } else {
                    $entrada = new EntradaUnaColumna($entradaData);
                }
                $this->entradas[] = $entrada;
            }
        }
    }

    public function guardarEntradas() {
        $data = array_map(function ($entrada) {
            return get_object_vars($entrada);
        }, $this->entradas);
        file_put_contents('blog.json', json_encode($data, JSON_PRETTY_PRINT));
    }

    public function obtenerEntradas() {
        return $this->entradas;
    }
}
