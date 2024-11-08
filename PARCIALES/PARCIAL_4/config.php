<?php
// Configuración de Google OAuth
define('CLIENT_ID', '100787409462-8j0c79t6mvte8f9tv3qctv55n1tnf035.apps.googleusercontent.com'); // Reemplaza con tu client_id de Google OAuth
define('CLIENT_SECRET', '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'); // Reemplaza con tu client_secret de Google OAuth
define('REDIRECT_URI', 'http://localhost/PARCIALES/PARCIAL_4/callback.php'); // URL de redireccionamiento tras autenticación

// Configuración de API de Google Books
define('GOOGLE_API_KEY', 'TU_GOOGLE_API_KEY'); // Reemplaza con tu API Key de Google Books

// Configuración de base de datos
define('DB_HOST', 'localhost');       // Servidor de base de datos
define('DB_NAME', 'biblioteca');      // Nombre de la base de datos, según el esquema proporcionado
define('DB_USER', 'root');      // Usuario de la base de datos
define('DB_PASS', '12345');   // Contraseña de la base de datos

// Conexión a la base de datos usando PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
