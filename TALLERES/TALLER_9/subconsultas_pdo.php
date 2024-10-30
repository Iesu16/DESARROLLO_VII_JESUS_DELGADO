<?php 
require_once "config_pdo.php"; 

$sql = "SELECT p.nombre, p.precio, c.nombre AS categoria,
        (SELECT AVG(precio) FROM productos WHERE categoria_id = p.categoria_id) AS promedio_categoria
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        WHERE p.precio > (
            SELECT AVG(precio)
            FROM productos p2
            WHERE p2.categoria_id = p.categoria_id
        )";

$stmt = $pdo->query($sql);

if ($stmt) {
    echo "<h3>Productos con precio mayor al promedio de su categoría:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: $" . number_format($row['precio'], 2) . ", ";
        echo "Categoría: {$row['categoria']}, Promedio categoría: $" . number_format($row['promedio_categoria'], 2) . "<br>";
    }
} else {
    die("ERROR: Could not execute query. " . $pdo->errorInfo()[2]);
}

$sql = "SELECT c.nombre, c.email,
        (SELECT SUM(total) FROM ventas WHERE cliente_id = c.id) AS total_compras,
        (SELECT AVG(total) FROM ventas) AS promedio_ventas
        FROM clientes c
        WHERE (
            SELECT SUM(total)
            FROM ventas
            WHERE cliente_id = c.id
        ) > (
            SELECT AVG(total)
            FROM ventas
        )";

$stmt = $pdo->query($sql);

if ($stmt) {
    echo "<h3>Clientes con compras superiores al promedio:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Total compras: $" . number_format($row['total_compras'], 2) . ", ";
        echo "Promedio general: $" . number_format($row['promedio_ventas'], 2) . "<br>";
    }
} else {
    die("ERROR: Could not execute query. " . $pdo->errorInfo()[2]);
}

$sql = "SELECT p.nombre, p.precio 
        FROM productos p 
        LEFT JOIN detalles_venta dv ON p.id = dv.producto_id 
        WHERE dv.producto_id IS NULL";

$stmt = $pdo->query($sql);

if ($stmt) {
    echo "<h3>Productos nunca vendidos:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Precio: $" . number_format($row['precio'], 2) . "<br>";
    }
} else {
    die("ERROR: Could not execute query. " . $pdo->errorInfo()[2]);
}

$sql = "SELECT c.nombre AS categoria, COUNT(p.id) AS num_productos, 
        SUM(p.precio * p.stock) AS valor_total_inventario 
        FROM categorias c 
        JOIN productos p ON p.categoria_id = c.id 
        GROUP BY c.id";

$stmt = $pdo->query($sql);

if ($stmt) {
    echo "<h3>Categorías con número de productos y valor total del inventario:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Categoría: {$row['categoria']}, Número de productos: {$row['num_productos']}, ";
        echo "Valor total del inventario: $" . number_format($row['valor_total_inventario'], 2) . "<br>";
    }
} else {
    die("ERROR: Could not execute query. " . $pdo->errorInfo()[2]);
}

$categoria_id = 1; 
$sql = "SELECT c.nombre, c.email 
        FROM clientes c 
        WHERE NOT EXISTS (
            SELECT 1 FROM productos p 
            WHERE p.categoria_id = :categoria_id 
            AND NOT EXISTS (
                SELECT 1 FROM detalles_venta dv 
                WHERE dv.producto_id = p.id 
                AND dv.venta_id IN (
                    SELECT v.id FROM ventas v WHERE v.cliente_id = c.id
                )
            )
        )";

$stmt = $pdo->prepare($sql);
$stmt->execute(['categoria_id' => $categoria_id]);

if ($stmt) {
    echo "<h3>Clientes que han comprado todos los productos de la categoría $categoria_id:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Cliente: {$row['nombre']}, Email: {$row['email']}<br>";
    }
} else {
    die("ERROR: Could not execute query. " . $pdo->errorInfo()[2]);
}

$sql = "SELECT p.nombre, 
        SUM(dv.cantidad * dv.precio_unitario) AS total_ventas_producto, 
        (SUM(dv.cantidad * dv.precio_unitario) / 
            (SELECT SUM(cantidad * precio_unitario) FROM detalles_venta) * 100) AS porcentaje_ventas 
        FROM productos p 
        JOIN detalles_venta dv ON p.id = dv.producto_id 
        GROUP BY p.id";

$stmt = $pdo->query($sql);

if ($stmt) {
    echo "<h3>Porcentaje de ventas de cada producto respecto al total de ventas:</h3>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Producto: {$row['nombre']}, Total Ventas: $" . number_format($row['total_ventas_producto'], 2) . ", ";
        echo "Porcentaje de ventas: " . number_format($row['porcentaje_ventas'], 2) . "%<br>";
    }
} else {
    die("ERROR: Could not execute query. " . $pdo->errorInfo()[2]);
}

$pdo = null;
?>
