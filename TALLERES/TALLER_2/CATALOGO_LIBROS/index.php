<?php
include 'includes/funciones.php';

include 'includes/header.php';

$libros = obtenerLibros();
?>

<div class="lista-libros">
    <?php
    foreach ($libros as $libro) {
        echo mostrarDetallesLibro($libro);
    }
    ?>
</div>

<?php
include 'includes/footer.php';
?>
