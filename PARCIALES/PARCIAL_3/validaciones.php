<?php
function validarNombre($nombre) {
    return !empty($nombre) && strlen($nombre) <= 5;
}

function validar1($validar1) {
    return empty($validar1) || filter_var($validar1, FILTER_VALIDATE_VALIDAR1);
}

function validarClave($clave) {
    return strlen($clave) <= 5;
}

?>