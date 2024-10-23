<?php
session_start();

// Redirigir al usuario si no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
</head>
<body>
    <section>
        <a href="logout.php">Cerrar Sesión</a>
    </section>

    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
    <p>Esta es tu área personal para ver las notas.</p>

    <?php
    // Leer el archivo JSON que contiene las notas
    $jsonData = file_get_contents('notas.json');
    // Decodificar el JSON a un array de PHP
    $data = json_decode($jsonData, true);

    // Verificar que el archivo JSON se ha cargado correctamente
    if ($data === null) {
        die("Error al cargar o decodificar el archivo JSON.");
    }

    // Verificar que existan las claves 'usuarios' y 'notas' en el JSON
    if (!isset($data['usuarios']) || !isset($data['notas'])) {
        die("Datos incompletos en el archivo JSON.");
    }

    // Obtener las notas
    $notas = $data['notas'];
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID Nota</th>
                <th>Materia</th>
                <th>Nota</th>
                <th>Comentarios</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar solo las notas del usuario en sesión
            foreach ($notas as $nota) {
                if ($nota['user_id'] == $_SESSION['userid']) {  // Filtrar las notas por el user_id del usuario en sesión
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($nota['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($nota['materia']) . '</td>';
                    echo '<td>' . htmlspecialchars($nota['nota']) . '</td>';
                    echo '<td>' . htmlspecialchars($nota['comentarios']) . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
