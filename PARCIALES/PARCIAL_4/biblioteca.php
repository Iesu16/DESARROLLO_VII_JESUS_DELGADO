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
    <style>
        /* General */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        h1 {
            color: #333;
            font-size: 2em;
            margin-bottom: 10px;
        }
        .container {
            max-width: 900px;
            width: 100%;
        }
        
        /* Botón de cerrar sesión */
        .logout-btn {
            background-color: #d9534f;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 20px;
            right: 20px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }
        
        /* Buscador */
        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }
        .search-bar input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            width: 80%;
            outline: none;
        }
        .search-bar button {
            padding: 10px;
            background-color: #337ab7;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-bar button:hover {
            background-color: #286090;
        }
        
        /* Grid y tarjetas de libros */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .card h2 {
            font-size: 1.3em;
            color: #333;
            margin: 10px 0;
        }
        .card p {
            font-size: 0.9em;
            color: #666;
            margin: 5px 0;
        }
        
        /* Formulario de reseña */
        .review-form textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-top: 10px;
            resize: none;
            font-size: 0.9em;
        }
        .review-form button {
            margin-top: 10px;
            padding: 8px 16px;
            border: none;
            background-color: #5cb85c;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .review-form button:hover {
            background-color: #4cae4c;
        }
        
        /* Botón de eliminar */
        .delete-btn {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.9em;
            color: #d9534f;
            text-decoration: none;
            transition: color 0.3s;
        }
        .delete-btn:hover {
            color: #c9302c;
        }
    </style>
</head>
<body>
    <h1>Mi Biblioteca</h1>
    <a href="logout.php" class="logout-btn">Cerrar sesión</a>

    <div class="container">
        <!-- Barra de búsqueda -->
        <form class="search-bar" method="get" action="buscar.php">
            <input type="text" name="query" placeholder="Buscar libros...">
            <button type="submit">Buscar</button>
        </form>

        <?php if (count($libros_guardados) > 0): ?>
            <div class="grid">
                <?php foreach ($libros_guardados as $libro): ?>
                    <div class="card">
                        <?php if ($libro['imagen_portada']): ?>
                            <img src="<?php echo htmlspecialchars($libro['imagen_portada']); ?>" alt="Portada de <?php echo htmlspecialchars($libro['titulo']); ?>">
                        <?php endif; ?>
                        <h2><?php echo htmlspecialchars($libro['titulo']); ?></h2>
                        <p><strong>Autor:</strong> <?php echo htmlspecialchars($libro['autor']); ?></p>
                        <p><strong>Reseña Personal:</strong> <?php echo htmlspecialchars($libro['reseña_personal']); ?></p>

                        <!-- Formulario para agregar o editar reseña -->
                        <form method="post" action="biblioteca.php" class="review-form">
                            <input type="hidden" name="libro_id" value="<?php echo $libro['id']; ?>">
                            <textarea name="reseña" placeholder="Escribe tu reseña..."><?php echo htmlspecialchars($libro['reseña_personal']); ?></textarea>
                            <button type="submit">Guardar reseña</button>
                        </form>

                        <!-- Opción para eliminar libro -->
                        <a href="biblioteca.php?eliminar=<?php echo $libro['id']; ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar este libro de tu biblioteca?');">Eliminar</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No has guardado ningún libro en tu biblioteca.</p>
        <?php endif; ?>
    </div>
</body>
</html>
