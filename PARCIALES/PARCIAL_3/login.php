<?php
    session_start();
    
    // Cargar y verificar el archivo JSON
    $jsonData = file_get_contents('data.json');
    if ($jsonData === false) {
        die("Error al cargar el archivo JSON.");
    }
    
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die("Error al decodificar el archivo JSON.");
    }
    
    $usuarios = $data['usuarios'];
    
    // Redirigir si ya está conectado
    if (isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit;
    }

    // Procesar formulario si es enviado por POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $user = $_POST['n_usuario'];
        $pass = $_POST['c_usuario'];

        // Buscar el usuario en la lista
        foreach ($usuarios as $usuario) {
            $user_S = $usuario['user'];
            $pass_S = $usuario['contrasena'];
            $id = $usuario['id'];
            
            // Verificar credenciales
            if ($user === $user_S && $pass === $pass_S) {
                $_SESSION['usuario'] = $user;        
                $_SESSION['contrasena'] = $pass;
                $_SESSION['userid'] = $id;
                header("Location: index.php");
                exit;
            }
        }

        // Si no se encontró el usuario
        echo "Error: Usuario No Registrado. " . '<a href="index.html">Volver</a>';
    }
?>
