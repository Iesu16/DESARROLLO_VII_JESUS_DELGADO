<?php
function validarNombre($nombre) {
    return !empty($nombre) && strlen($nombre) <= 50 && preg_match("/^[a-zA-Z\s]+$/", $nombre);
}

function validarFechaNacimiento($fecha) {
    if (empty($fecha)) {
        return false;
    }
    $fechaActual = new DateTime();
    $fechaNacimiento = new DateTime($fecha);
    return $fechaNacimiento <= $fechaActual;
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarSitioWeb($sitioWeb) {
    return empty($sitioWeb) || filter_var($sitioWeb, FILTER_VALIDATE_URL);
}

function validarGenero($genero) {
    $generosValidos = ['masculino', 'femenino', 'otro'];
    return in_array($genero, $generosValidos);
}

function validarIntereses($intereses) {
    $interesesValidos = ['deportes', 'musica', 'lectura'];
    if (!is_array($intereses)) {
        return false;
    }
    return empty($intereses) || count(array_intersect($intereses, $interesesValidos)) === count($intereses);
}

function validarComentarios($comentarios) {
    return strlen($comentarios) <= 500;
}

function validarFotoPerfil($archivo) {
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    $tamanoMaximo = 1 * 1024 * 1024; // 1MB

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    $tipoReal = mime_content_type($archivo['tmp_name']);
    if (!in_array($tipoReal, $tiposPermitidos)) {
        return false;
    }

    if ($archivo['size'] > $tamanoMaximo) {
        return false;
    }

    return true;
}
?>
