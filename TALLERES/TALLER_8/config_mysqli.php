<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '12345');  
define('DB_NAME', 'taller8_db');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn === false){
    die("ERROR: No se pudo conectar. " . mysqli_connect_error());
}
?>
