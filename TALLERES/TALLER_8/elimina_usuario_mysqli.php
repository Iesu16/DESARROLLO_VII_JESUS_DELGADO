<?php
require_once "config_mysqli.php"; // Configuración de la conexión a MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM usuarios WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if(mysqli_stmt_execute($stmt)){
            echo "Registro eliminado correctamente.";
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
    <input type="submit" value="Eliminar Usuario">
</form>
