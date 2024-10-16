<?php
require_once "config_mysqli.php";

$sql = "SELECT AVG(publicaciones_por_usuario) AS promedio 
        FROM (SELECT COUNT(*) AS publicaciones_por_usuario 
              FROM publicaciones 
              GROUP BY usuario_id) AS subconsulta";

if($result = mysqli_query($conn, $sql)){
    if($row = mysqli_fetch_assoc($result)){
        echo "Promedio de publicaciones por usuario: " . $row['promedio'];
    }
} else{
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
