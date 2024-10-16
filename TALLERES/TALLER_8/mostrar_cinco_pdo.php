<?php
require_once "config_pdo.php";

$sql = "SELECT usuarios.nombre, publicaciones.titulo, publicaciones.fecha_publicacion 
        FROM publicaciones 
        JOIN usuarios ON publicaciones.usuario_id = usuarios.id 
        ORDER BY publicaciones.fecha_publicacion DESC 
        LIMIT 5";

$stmt = $conn->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){
    echo "Autor: " . $row['nombre'] . " - Título: " . $row['titulo'] . " - Fecha: " . $row['fecha_publicacion'] . "<br>";
}
?>
