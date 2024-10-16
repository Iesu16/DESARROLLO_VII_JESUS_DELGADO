<?php
require_once "config_pdo.php";

$sql = "SELECT AVG(publicaciones_por_usuario) AS promedio 
        FROM (SELECT COUNT(*) AS publicaciones_por_usuario 
              FROM publicaciones 
              GROUP BY usuario_id) AS subconsulta";

$stmt = $conn->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Promedio de publicaciones por usuario: " . $result['promedio'];
?>
