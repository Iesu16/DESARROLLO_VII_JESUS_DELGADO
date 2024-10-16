<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Agregar fecha de nacimiento al listado de campos
    $campos = ['nombre', 'email', 'sitio_web', 'genero', 'intereses', 'comentarios', 'fecha_nacimiento'];

    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $funcionSanitizar = "sanitizar" . ucfirst(str_replace('_', '', $campo));
            $valorSanitizado = call_user_func($funcionSanitizar, $valor);
            $datos[$campo] = $valorSanitizado;

            $funcionValidar = "validar" . ucfirst(str_replace('_', '', $campo));
            if (!call_user_func($funcionValidar, $valorSanitizado)) {
                $errores[] = "El campo $campo no es válido.";
            }
        }
    }

    // Cálculo de la edad
    if (isset($datos['fecha_nacimiento'])) {
        $fechaNacimiento = new DateTime($datos['fecha_nacimiento']);
        $hoy = new DateTime();
        if ($fechaNacimiento > $hoy) {
            $errores[] = "La fecha de nacimiento no puede ser en el futuro.";
        } else {
            $edadCalculada = $hoy->diff($fechaNacimiento)->y;
            $datos['edad'] = $edadCalculada;
        }
    }

    // Procesar la foto de perfil (con nombre único)
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            $nombreArchivo = uniqid() . '-' . basename($_FILES['foto_perfil']['name']);
            $rutaDestino = 'uploads/' . $nombreArchivo;
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        // Guardar los datos en archivo JSON
        $archivoDatos = 'datos.json';
        if (file_exists($archivoDatos)) {
            $registros = json_decode(file_get_contents($archivoDatos), true);
        } else {
            $registros = [];
        }
        $registros[] = $datos;
        file_put_contents($archivoDatos, json_encode($registros, JSON_PRETTY_PRINT));

        // Mostrar los datos procesados
        echo "<h2>Datos Recibidos:</h2>";
        echo "<table border='1'>";
        foreach ($datos as $campo => $valor) {
            echo "<tr><th>" . ucfirst($campo) . "</th>";
            if ($campo === 'intereses') {
                echo "<td>" . implode(", ", $valor) . "</td>";
            } elseif ($campo === 'foto_perfil') {
                echo "<td><img src='$valor' width='100'></td>";
            } else {
                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Mostrar errores
        echo "<h2>Errores:</h2>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }

    echo "<br><a href='formulario.html'>Volver al formulario</a>";
}
?>
