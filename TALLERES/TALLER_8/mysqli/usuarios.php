<?php
require_once 'config.php';

function registrarUsuario($nombre, $email, $contraseña) {
    global $conn;
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, password_hash($contraseña, PASSWORD_DEFAULT));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function listarUsuarios($pagina, $registros_por_pagina) {
    global $conn;
    $inicio = ($pagina - 1) * $registros_por_pagina;
    $sql = "SELECT * FROM usuarios LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $inicio, $registros_por_pagina);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    // Mostrar usuarios
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "Nombre: " . $row['nombre'] . " - Email: " . $row['email'] . "<br>";
    }

    mysqli_stmt_close($stmt);
}

function buscarUsuario($termino) {
    global $conn;
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE ? OR email LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    $termino_con_wildcard = "%" . $termino . "%";
    mysqli_stmt_bind_param($stmt, "ss", $termino_con_wildcard, $termino_con_wildcard);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "Nombre: " . $row['nombre'] . " - Email: " . $row['email'] . "<br>";
    }

    mysqli_stmt_close($stmt);
}

function actualizarUsuario($id, $nombre, $email, $contraseña) {
    global $conn;
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, contraseña = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nombre, $email, password_hash($contraseña, PASSWORD_DEFAULT), $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function eliminarUsuario($id) {
    global $conn;
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>
