<?php
require_once "config_pdo.php"; // Configuración de la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM usuarios WHERE id = :id";
    
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()){
            echo "Registro eliminado correctamente.";
        } else{
            echo "ERROR: No se pudo ejecutar la consulta.";
        }
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="1"> <!-- Cambia 1 por el id real -->
    <input type="submit" value="Eliminar Usuario">
</form>
