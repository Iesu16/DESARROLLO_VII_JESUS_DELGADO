<?php
session_start();
require 'config.php';
require 'database.php'; // Archivo de conexión a base de datos

if (isset($_GET['code'])) {
   // $token = obtenerTokenDeGoogle($_GET['code']); // Función para obtener el token de Google
   // $user_info = obtenerDatosUsuarioGoogle($token); // Función para obtener datos de perfil

    $email = $user_info['email'];
    $nombre = $user_info['name'];
    $google_id = $user_info['id'];

    // Guarda el usuario en la base de datos si es nuevo
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE google_id = ?");
    $stmt->execute([$google_id]);
    $user = $stmt->fetch();

    if (!$user) {
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, nombre, google_id) VALUES (?, ?, ?)");
        $stmt->execute([$email, $nombre, $google_id]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
    } else {
        $_SESSION['user_id'] = $user['id'];
    }

    header("Location: biblioteca.php");
    exit;
}
?>