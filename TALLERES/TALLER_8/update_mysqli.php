<?php
require_once "config_mysqli.php"; // Configuración de la conexión a MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);
        
        if(mysqli_stmt_execute($stmt)){
            echo "Registro actualizado correctamente.";
        } else{
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }
    
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="1"> <!-- Cambia 1 por el id real -->
    <div><label>Nombre</label><input type="text" name="nombre" required></div>
    <div><label>Email</label><input type="email" name="email" required></div>
    <input type="submit" value="Actualizar Usuario">
</form>
