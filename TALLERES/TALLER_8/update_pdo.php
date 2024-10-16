<?php
require_once "config_pdo.php"; // Configuración de la conexión PDO

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
    
    if($stmt = $conn->prepare($sql)){
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        
        if($stmt->execute()){
            echo "Registro actualizado correctamente.";
        } else{
            echo "ERROR: No se pudo ejecutar la consulta.";
        }
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="id" value="1"> <!-- Cambia 1 por el id real -->
    <div><label>Nombre</label><input type="text" name="nombre" required></div>
    <div><label>Email</label><input type="email" name="email" required></div>
    <input type="submit" value="Actualizar Usuario">
</form>
