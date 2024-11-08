<?php
session_start();
require 'config.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Obtiene el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

// Función para obtener la lista de libros guardados del usuario
function obtenerLibrosGuardados($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM libros_guardados WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

// Maneja la eliminación de un libro
if (isset($_GET['eliminar'])) {
    $libro_id = $_GET['eliminar'];
    $stmt = $pdo->prepare("DELETE FROM libros_guardados WHERE id = ? AND user_id = ?");
    $stmt->execute([$libro_id, $user_id]);
    header("Location: biblioteca.php");
    exit;
}

// Maneja la adición o actualización de una reseña personal
if (isset($_POST['reseña']) && isset($_POST['libro_id'])) {
    $reseña = $_POST['reseña'];
    $libro_id = $_POST['libro_id'];
    $stmt = $pdo->prepare("UPDATE libros_guardados SET reseña_personal = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$reseña, $libro_id, $user_id]);
    header("Location: biblioteca.php");
    exit;
}

// Obtiene la lista de libros guardados del usuario
$libros_guardados = obtenerLibrosGuardados($pdo, $user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Biblioteca</title>
</head>
<body>
    <h1>Mi Biblioteca</h1>
    <a href="logout.php">Cerrar sesión</a>

    <?php if (count($libros_guardados) > 0): ?>
        <ul>
            <?php foreach ($libros_guardados as $libro): ?>
                <li>
                    <h2><?php echo htmlspecialchars($libro['titulo']); ?></h2>
                    <p><strong>Autor:</strong> <?php echo htmlspecialchars($libro['autor']); ?></p>
                    <?php if ($libro['imagen_portada']): ?>
                        <img src="<?php echo htmlspecialchars($libro['imagen_portada']); ?>" alt="Portada de <?php echo htmlspecialchars($libro['titulo']); ?>" width="100">
                    <?php endif; ?>
                    <p><strong>Reseña Personal:</strong> <?php echo htmlspecialchars($libro['reseña_personal']); ?></p>

                    <!-- Formulario para agregar o editar reseña -->
                    <form method="post" action="biblioteca.php">
                        <input type="hidden" name="libro_id" value="<?php echo $libro['id']; ?>">
                        <textarea name="reseña" placeholder="Escribe tu reseña..."><?php echo htmlspecialchars($libro['reseña_personal']); ?></textarea>
                        <button type="submit">Guardar reseña</button>
                    </form>

                    <!-- Opción para eliminar libro -->
                    <a href="biblioteca.php?eliminar=<?php echo $libro['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este libro de tu biblioteca?');">Eliminar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No has guardado ningún libro en tu biblioteca.</p>
    <?php endif; ?>
</body>
</html>
