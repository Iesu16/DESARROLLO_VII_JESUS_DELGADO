<?php
// 1. Crear un string JSON con datos de una tienda en línea
$jsonDatos = '
{
    "tienda": "ElectroTech",
    "productos": [
        {"id": 1, "nombre": "Laptop Gamer", "precio": 1200, "categorias": ["electronica", "computadoras"]},
        {"id": 2, "nombre": "Smartphone 5G", "precio": 800, "categorias": ["electronica", "celulares"]},
        {"id": 3, "nombre": "Auriculares Bluetooth", "precio": 150, "categorias": ["electronica", "accesorios"]},
        {"id": 4, "nombre": "Smart TV 4K", "precio": 700, "categorias": ["electronica", "televisores"]},
        {"id": 5, "nombre": "Tablet", "precio": 300, "categorias": ["electronica", "computadoras"]}
    ],
    "clientes": [
        {"id": 101, "nombre": "Ana López", "email": "ana@example.com"},
        {"id": 102, "nombre": "Carlos Gómez", "email": "carlos@example.com"},
        {"id": 103, "nombre": "María Rodríguez", "email": "maria@example.com"}
    ]
}
';

// 2. Convertir el JSON a un arreglo asociativo de PHP
$tiendaData = json_decode($jsonDatos, true);

// 3. Función para imprimir los productos
function imprimirProductos($productos) {
    array_walk($productos, function($producto) {
        echo "{$producto['nombre']} - {$producto['precio']} - Categorías: " . implode(", ", $producto['categorias']) . "<br>";
    });
}

echo "Productos de {$tiendaData['tienda']}:<br>";
imprimirProductos($tiendaData['productos']);

// 4. Calcular el valor total del inventario
$valorTotal = array_reduce($tiendaData['productos'], fn($total, $producto) => $total + $producto['precio'], 0);

echo "<br>Valor total del inventario: $$valorTotal<br>";

// 5. Encontrar el producto más caro
$productoMasCaro = array_reduce($tiendaData['productos'], fn($max, $producto) => ($producto['precio'] > $max['precio']) ? $producto : $max, $tiendaData['productos'][0]);

echo "<br>Producto más caro: {$productoMasCaro['nombre']} ({$productoMasCaro['precio']})<br>";

// 6. Filtrar productos por categoría
function filtrarPorCategoria($productos, $categoria) {
    return array_filter($productos, fn($producto) => in_array($categoria, $producto['categorias']));
}

$productosDeComputadoras = filtrarPorCategoria($tiendaData['productos'], "computadoras");
echo "<br>Productos en la categoría 'computadoras':<br>";
imprimirProductos($productosDeComputadoras);

// 7. Agregar un nuevo producto
$nuevoProducto = [
    "id" => 6,
    "nombre" => "Smartwatch",
    "precio" => 250,
    "categorias" => ["electronica", "accesorios", "wearables"]
];
$tiendaData['productos'][] = $nuevoProducto;

// 8. Convertir el arreglo actualizado de vuelta a JSON
$jsonActualizado = json_encode($tiendaData, JSON_PRETTY_PRINT);
echo "<br>Datos actualizados de la tienda (JSON):<br>$jsonActualizado<br>";

function generarResumenVentas($ventas, $productos, $clientes) {
    $totalVentas = array_reduce($ventas, fn($total, $venta) => $total + ($venta['cantidad'] * $productos[$venta['producto_id'] - 1]['precio']), 0);

    $productosVendidos = array_reduce($ventas, function($carry, $venta) {
        if (!isset($carry[$venta['producto_id']])) $carry[$venta['producto_id']] = 0;
        $carry[$venta['producto_id']] += $venta['cantidad'];
        return $carry;
    }, []);

    $productoMasVendidoId = array_reduce(array_keys($productosVendidos), fn($max, $productoId) => ($productosVendidos[$productoId] > $productosVendidos[$max]) ? $productoId : $max, array_keys($productosVendidos)[0]);

    $clientesCompras = array_reduce($ventas, function($carry, $venta) {
        if (!isset($carry[$venta['cliente_id']])) $carry[$venta['cliente_id']] = 0;
        $carry[$venta['cliente_id']] += $venta['cantidad'];
        return $carry;
    }, []);

    $clienteMasCompradorId = array_reduce(array_keys($clientesCompras), fn($max, $clienteId) => ($clientesCompras[$clienteId] > $clientesCompras[$max]) ? $clienteId : $max, array_keys($clientesCompras)[0]);

    return [
        'total_ventas' => $totalVentas,
        'producto_mas_vendido' => $productos[$productoMasVendidoId - 1]['nombre'],
        'cliente_mas_comprador' => $clientes[$clienteMasCompradorId - 101]['nombre']
    ];
}

$ventas = [
    ['producto_id' => 1, 'cliente_id' => 101, 'cantidad' => 2, 'fecha' => '2024-09-01'],
    ['producto_id' => 2, 'cliente_id' => 102, 'cantidad' => 1, 'fecha' => '2024-09-02'],
    ['producto_id' => 1, 'cliente_id' => 103, 'cantidad' => 1, 'fecha' => '2024-09-03'],
    ['producto_id' => 3, 'cliente_id' => 101, 'cantidad' => 3, 'fecha' => '2024-09-04'],
    ['producto_id' => 2, 'cliente_id' => 103, 'cantidad' => 2, 'fecha' => '2024-09-05'],
];

$resumenVentas = generarResumenVentas($ventas, $tiendaData['productos'], $tiendaData['clientes']);

echo "<br>Resumen de Ventas:<br>";
echo "Total de ventas: $" . $resumenVentas['total_ventas'] . "<br>";
echo "Producto más vendido: " . $resumenVentas['producto_mas_vendido'] . "<br>";
echo "Cliente que más ha comprado: " . $resumenVentas['cliente_mas_comprador'] . "<br>";
?>
