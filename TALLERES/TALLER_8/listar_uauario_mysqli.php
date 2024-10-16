<?php
require_once "config_mysqli.php";

$sql = "SELECT usuarios.nombre, usuarios.email 
        FROM usuarios 
        LEFT JOIN publicaciones ON usuarios.id = publicaciones.usuario_id 
        WHERE publicaciones.id IS NULL";

if($result = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_assoc($result)){
        echo "Usuario: " . $row['nombre'] . " - Email: " . $row['email'] . "<br>";
    }
} else{
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
