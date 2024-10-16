<?php
require_once "config_pdo.php";

$sql = "SELECT usuarios.nombre, usuarios.email 
        FROM usuarios 
        LEFT JOIN publicaciones ON usuarios.id = publicaciones.usuario_id 
        WHERE publicaciones.id IS NULL";

$stmt = $conn->query($sql);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){
    echo "Usuario: " . $row['nombre'] . " - Email: " . $row['email'] . "<br>";
}
?>
