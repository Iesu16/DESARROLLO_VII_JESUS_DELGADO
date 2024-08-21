<?php
// Función que simula la obtención de libros de una base de datos
function obtenerLibros() {
    return [
        [
            'titulo' => 'Naruto',
            'autor' => 'Masashi Kishimoto',
            'anio' => 1999,
            'genero' => 'Shonen'
        ],
        [
            'titulo' => 'One Piece',
            'autor' => 'Eiichiro Oda',
            'anio' => 1997,
            'genero' => 'Shonen'
        ],
        [
            'titulo' => 'Dragon Ball',
            'autor' => 'Akira Toriyama',
            'anio' => 1984,
            'genero' => 'Shonen'
        ],
        [
            'titulo' => 'My Hero Academia',
            'autor' => 'Kohei Horikoshi',
            'anio' => 2014,
            'genero' => 'Shonen'
        ],
        [
            'titulo' => 'Attack on Titan',
            'autor' => 'Hajime Isayama',
            'anio' => 2009,
            'genero' => 'Shonen'
        ]
    ];
}


// Función que muestra los detalles de un libro en formato HTML
function mostrarDetallesLibro($libro) {
    return "
    <div class='libro'>
        <h2>{$libro['titulo']}</h2>
        <p><strong>Autor:</strong> {$libro['autor']}</p>
        <p><strong>Año:</strong> {$libro['anio']}</p>
        <p><strong>Género:</strong> {$libro['genero']}</p>
    </div>";
}
?>
