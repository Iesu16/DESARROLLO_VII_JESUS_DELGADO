<?php
require_once 'estudiante.php';

class SistemaGestionEstudiantes {
    private array $estudiantes = [];
    private array $graduados = [];

    public function agregarEstudiante(Estudiante $estudiante): void {
        $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
    }

    public function obtenerEstudiante(int $id): ?Estudiante {
        return $this->estudiantes[$id] ?? null;
    }

    public function listarEstudiantes(): array {
        return $this->estudiantes;
    }

    public function calcularPromedioGeneral(): float {
        if (count($this->estudiantes) === 0) return 0;
        $promedios = array_map(fn($est) => $est->obtenerPromedio(), $this->estudiantes);
        return array_sum($promedios) / count($promedios);
    }

    public function obtenerEstudiantesPorCarrera(string $carrera): array {
        return array_filter($this->estudiantes, fn($est) => strtolower($est->obtenerDetalles()['carrera']) === strtolower($carrera));
    }

    public function obtenerMejorEstudiante(): ?Estudiante {
        if (count($this->estudiantes) === 0) return null;
        return array_reduce($this->estudiantes, function($carry, $est) {
            return ($carry === null || $est->obtenerPromedio() > $carry->obtenerPromedio()) ? $est : $carry;
        });
    }

    public function generarReporteRendimiento(): array {
        $materias = [];
        foreach ($this->estudiantes as $estudiante) {
            foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                if (!isset($materias[$materia])) {
                    $materias[$materia] = ['total' => 0, 'count' => 0, 'max' => $calificacion, 'min' => $calificacion];
                }
                $materias[$materia]['total'] += $calificacion;
                $materias[$materia]['count']++;
                if ($calificacion > $materias[$materia]['max']) {
                    $materias[$materia]['max'] = $calificacion;
                }
                if ($calificacion < $materias[$materia]['min']) {
                    $materias[$materia]['min'] = $calificacion;
                }
            }
        }

        return array_map(function($materia) {
            return [
                'promedio' => $materia['total'] / $materia['count'],
                'max' => $materia['max'],
                'min' => $materia['min']
            ];
        }, $materias);
    }

    public function graduarEstudiante(int $id): void {
        if (isset($this->estudiantes[$id])) {
            $this->graduados[$id] = $this->estudiantes[$id];
            unset($this->estudiantes[$id]);
        }
    }

    public function generarRanking(): array {
        $ranking = $this->estudiantes;
        usort($ranking, fn($a, $b) => $b->obtenerPromedio() <=> $a->obtenerPromedio());
        return $ranking;
    }

    public function buscarEstudiantes(string $termino): array {
        return array_filter($this->estudiantes, function($est) use ($termino) {
            return stripos($est->obtenerDetalles()['nombre'], $termino) !== false || stripos($est->obtenerDetalles()['carrera'], $termino) !== false;
        });
    }

    public function generarEstadisticasPorCarrera(): array {
        $estadisticas = [];
        foreach ($this->estudiantes as $estudiante) {
            $carrera = $estudiante->obtenerDetalles()['carrera'];
            if (!isset($estadisticas[$carrera])) {
                $estadisticas[$carrera] = ['count' => 0, 'totalPromedio' => 0, 'mejorEstudiante' => null];
            }
            $estadisticas[$carrera]['count']++;
            $estadisticas[$carrera]['totalPromedio'] += $estudiante->obtenerPromedio();
            if ($estadisticas[$carrera]['mejorEstudiante'] === null || $estudiante->obtenerPromedio() > $estadisticas[$carrera]['mejorEstudiante']->obtenerPromedio()) {
                $estadisticas[$carrera]['mejorEstudiante'] = $estudiante;
            }
        }

        foreach ($estadisticas as $carrera => $data) {
            $estadisticas[$carrera]['promedioGeneral'] = $data['totalPromedio'] / $data['count'];
        }

        return $estadisticas;
    }

    public function aplicarFlags(): void {
        foreach ($this->estudiantes as $estudiante) {
            $promedio = $estudiante->obtenerPromedio();
            $flags = [];
            if ($promedio < 6) {
                $flags[] = "En riesgo académico";
            }
            if ($promedio >= 9) {
                $flags[] = "Honor roll";
            }
             $estudiante->flags = $flags; 
        }
    }
}
?>
