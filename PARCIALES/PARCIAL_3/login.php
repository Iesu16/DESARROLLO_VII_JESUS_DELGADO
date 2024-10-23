<?php
    session_start();
    $jsonData = file_get_contents('data.json');
    $data = json_decode($jsonData, true);
    $usuarios = $data['usuarios'];
    if(isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit;
    }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $user = $_POST['nombre_usuario'];
        $pass = $_POST['contra_usuario'];

        foreach ($usuarios as $usuario){
            $user_S = $usuario['user'];
            $pass_S = $usuario['contrasena'];
            $id = $usuario['id'];
            
            if($user === $user_S && $pass === $pass_S){
                $_SESSION['usuario'] = $user;        
                $_SESSION['contrasena'] = $pass;
                $_SESSION['userid'] = $id;
                header("Location: ../index.php");
                exit;
            }
        }
    }

    echo "Error: Usuario No Registrado. " . '<a href="Iniciar_Sesion.php">Volver</a>';
?>
