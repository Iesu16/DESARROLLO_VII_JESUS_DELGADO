<?php
require_once "config_mysqli.php";

$sql = "SELECT usuarios.nombre, publicaciones.titulo, publicaciones.fecha_publicacion 
        FROM publicaciones 
        JOIN usuarios ON publicaciones.usuario_id = usuarios.id 
        ORDER BY publicaciones.fecha_publicacion DESC 
        LIMIT 5";

if($result = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_assoc($result)){
        echo "Autor: " . $row['nombre'] . " - Título: " . $row['titulo'] . " - Fecha: " . $row['fecha_publicacion'] . "<br>";
    }
} else{
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
