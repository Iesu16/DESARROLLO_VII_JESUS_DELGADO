<?php
// Incluir el archivo de funciones
include 'includes/funciones.php';

// Incluir archivos de encabezado y pie de página
include 'includes/header.php';

// Obtener la lista de libros
$libros = obtenerLibros();
?>

<div class="lista-libros">
    <?php
    // Recorrer la lista de libros y mostrar sus detalles
    foreach ($libros as $libro) {
        echo mostrarDetallesLibro($libro);
    }
    ?>
</div>

<?php
// Incluir el archivo de pie de página
include 'includes/footer.php';
?>
