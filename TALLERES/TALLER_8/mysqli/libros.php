<?php
require_once 'config.php';

function agregarLibro($titulo, $autor, $isbn, $anio, $cantidad) {
    global $conn;
    $sql = "INSERT INTO libros (titulo, autor, isbn, anio_publicacion, cantidad_disponible) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $autor, $isbn, $anio, $cantidad);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function listarLibros($pagina, $registros_por_pagina) {
    global $conn;
    $inicio = ($pagina - 1) * $registros_por_pagina;
    $sql = "SELECT * FROM libros LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $inicio, $registros_por_pagina);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "Título: " . $row['titulo'] . " - Autor: " . $row['autor'] . "<br>";
    }

    mysqli_stmt_close($stmt);
}

function buscarLibro($termino) {
    global $conn;
    $sql = "SELECT * FROM libros WHERE titulo LIKE ? OR autor LIKE ? OR isbn LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    $termino_con_wildcard = "%" . $termino . "%";
    mysqli_stmt_bind_param($stmt, "sss", $termino_con_wildcard, $termino_con_wildcard, $termino_con_wildcard);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "Título: " . $row['titulo'] . " - Autor: " . $row['autor'] . "<br>";
    }

    mysqli_stmt_close($stmt);
}

function actualizarLibro($id, $titulo, $autor, $isbn, $anio, $cantidad) {
    global $conn;
    $sql = "UPDATE libros SET titulo = ?, autor = ?, isbn = ?, anio_publicacion = ?, cantidad_disponible = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssii", $titulo, $autor, $isbn, $anio, $cantidad, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function eliminarLibro($id) {
    global $conn;
    $sql = "DELETE FROM libros WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>
