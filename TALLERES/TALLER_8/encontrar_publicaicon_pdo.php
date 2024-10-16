<?php
require_once "config_pdo.php";

$sql = "SELECT usuarios.nombre, publicaciones.titulo, MAX(publicaciones.fecha_publicacion) AS fecha_publicacion 
        FROM publicaciones 
        JOIN usuarios ON publicaciones.usuario_id = usuarios.id 
        GROUP BY usuarios.id";

$stmt = $conn->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){
    echo "Usuario: " . $row['nombre'] . " - Última publicación: " . $row['titulo'] . " - Fecha: " . $row['fecha_publicacion'] . "<br>";
}
?>
