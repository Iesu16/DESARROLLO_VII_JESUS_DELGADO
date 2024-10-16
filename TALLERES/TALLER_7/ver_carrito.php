<?php
require 'configsesion.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "El carrito está vacío.";
    exit();
}

$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Carrito</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($_SESSION['carrito'] as $id => $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
            <td><?php echo htmlspecialchars($item['precio']); ?> $</td>
            <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
            <td><?php echo htmlspecialchars($item['precio'] * $item['cantidad']); ?> $</td>
            <td>
                <a href="eliminar_del_carrito.php?id=<?php echo $id; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2>Total: <?php echo htmlspecialchars($total); ?> $</h2>
    <a href="checkout.php">Finalizar compra</a>
</body>
</html>
