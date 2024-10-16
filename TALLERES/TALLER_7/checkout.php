<?php
require 'configsesion.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío. No se puede realizar la compra.";
    exit();
}

$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['carrito']);
   
    setUserCookie("Usuario Ejemplo");
    
    echo "¡Compra realizada con éxito! Total: " . htmlspecialchars($total) . " $";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <h1>Finalizar Compra</h1>
    <h2>Total a Pagar: <?php echo htmlspecialchars($total); ?> $</h2>
    <form method="POST">
        <input type="submit" value="Confirmar Compra">
    </form>
</body>
</html>
