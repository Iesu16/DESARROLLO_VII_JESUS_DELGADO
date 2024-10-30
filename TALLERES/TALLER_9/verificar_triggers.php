<?php
require_once "config_pdo.php"; // Incluye la configuración de PDO

// Función para registrar una venta
function registrarVenta($pdo, $cliente_id, $categoria_id, $monto_total) {
    try {
        $stmt = $pdo->prepare("INSERT INTO ventas (cliente_id, categoria_id, monto_total) VALUES (?, ?, ?)");
        $stmt->execute([$cliente_id, $categoria_id, $monto_total]);
        echo "Venta registrada con éxito.<br>";
    } catch (PDOException $e) {
        echo "Error al registrar la venta: " . $e->getMessage() . "<br>";
    }
}

// Función para actualizar el estado de un cliente
function actualizarEstadoCliente($pdo, $cliente_id, $nuevo_estado) {
    try {
        $stmt = $pdo->prepare("UPDATE clientes SET estado = ? WHERE id = ?");
        $stmt->execute([$nuevo_estado, $cliente_id]);
        echo "Estado del cliente actualizado a $nuevo_estado.<br>";
    } catch (PDOException $e) {
        echo "Error al actualizar estado del cliente: " . $e->getMessage() . "<br>";
    }
}

// Función para verificar alertas de stock
function verificarAlertasStock($pdo) {
    $stmt = $pdo->query("SELECT * FROM alertas_stock");
    $alertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($alertas) {
        echo "<h3>Alertas de Stock Crítico:</h3>";
        foreach ($alertas as $alerta) {
            echo "Producto ID: {$alerta['producto_id']} - Mensaje: {$alerta['mensaje']} - Fecha: {$alerta['fecha_alerta']}<br>";
        }
    } else {
        echo "No hay alertas de stock crítico.<br>";
    }
}

// Ejemplo de uso
registrarVenta($pdo, 1, 1, 200); // Registrar una venta
registrarVenta($pdo, 1, 1, 600); // Registrar otra venta para el mismo cliente

// Actualizar el estado de un cliente
actualizarEstadoCliente($pdo, 1, 'inactivo');

// Verificar alertas de stock
verificarAlertasStock($pdo);

$pdo = null;
?>
