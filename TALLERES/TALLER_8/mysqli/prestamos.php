<?php
require_once 'config.php';

function registrarPrestamo($usuario_id, $libro_id) {
    global $conn;
    mysqli_begin_transaction($conn);
    try {
        // Registrar el préstamo
        $sql = "INSERT INTO prestamos (usuario_id, libro_id, fecha_prestamo) VALUES (?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $libro_id);
        mysqli_stmt_execute($stmt);
        
        // Actualizar cantidad de libros
        $sql2 = "UPDATE libros SET cantidad = cantidad - 1 WHERE id = ?";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "i", $libro_id);
        mysqli_stmt_execute($stmt2);
        
        mysqli_commit($conn);
        echo "Préstamo registrado con éxito.";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        registrarError($e->getMessage());
        echo "Se produjo un error: " . $e->getMessage();
    }
}

function listarPrestamos() {
    global $conn;
    $sql = "SELECT prestamos.*, usuarios.nombre AS usuario, libros.titulo AS libro
            FROM prestamos
            JOIN usuarios ON prestamos.usuario_id = usuarios.id
            JOIN libros ON prestamos.libro_id = libros.id";
    $resultado = mysqli_query($conn, $sql);
    
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "Usuario: " . $row['usuario'] . " - Libro: " . $row['libro'] . " - Fecha de Préstamo: " . $row['fecha_prestamo'] . "<br>";
        }
    } else {
        echo "No hay préstamos activos.";
    }
}

function registrarDevolucion($prestamo_id) {
    global $conn;
    mysqli_begin_transaction($conn);
    try {
        // Eliminar el préstamo
        $sql = "DELETE FROM prestamos WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $prestamo_id);
        mysqli_stmt_execute($stmt);
        
        // Actualizar cantidad de libros disponibles
        $sql2 = "UPDATE libros SET cantidad = cantidad + 1 WHERE id = (SELECT libro_id FROM prestamos WHERE id = ?)";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "i", $prestamo_id);
        mysqli_stmt_execute($stmt2);
        
        mysqli_commit($conn);
        echo "Devolución registrada con éxito.";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        registrarError($e->getMessage());
        echo "Se produjo un error: " . $e->getMessage();
    }
}

function registrarError($mensaje) {
    // Registrar error en un archivo de log
    $fecha = date('Y-m-d H:i:s');
    $log = "$fecha - $mensaje\n";
    file_put_contents('errores.log', $log, FILE_APPEND);
}
?>
