<?php
require_once "config_pdo.php"; 

function registrarVenta($pdo, $cliente_id, $producto_id, $cantidad) {
    $query = "CALL sp_registrar_venta(?, ?, ?, @venta_id)";
    $stmt = $pdo->prepare($query);
    
    try {
        $stmt->execute([$cliente_id, $producto_id, $cantidad]);

        $result = $pdo->query("SELECT @venta_id AS venta_id")->fetch(PDO::FETCH_ASSOC);
        
        echo "Venta registrada con éxito. ID de venta: " . $result['venta_id'];
    } catch (PDOException $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    }
}

function obtenerEstadisticasCliente($pdo, $cliente_id) {
    $query = "CALL sp_estadisticas_cliente(?)";
    $stmt = $pdo->prepare($query);
    
    try {
        $stmt->execute([$cliente_id]);
        $estadisticas = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($estadisticas) {
            echo "<h3>Estadísticas del Cliente</h3>";
            echo "Nombre: " . htmlspecialchars($estadisticas['nombre']) . "<br>";
            echo "Membresía: " . htmlspecialchars($estadisticas['nivel_membresia']) . "<br>";
            echo "Total compras: " . htmlspecialchars($estadisticas['total_compras']) . "<br>";
            echo "Total gastado: $" . htmlspecialchars($estadisticas['total_gastado']) . "<br>";
            echo "Promedio de compra: $" . htmlspecialchars($estadisticas['promedio_compra']) . "<br>";
            echo "Últimos productos: " . htmlspecialchars($estadisticas['ultimos_productos']) . "<br>";
        } else {
            echo "No se encontraron estadísticas para el cliente.";
        }
    } catch (PDOException $e) {
        echo "Error al obtener estadísticas: " . $e->getMessage();
    }
}

function procesarDevolucion($pdo, $venta_id, $cantidad) {
    $sql = "CALL procesar_devolucion(?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$venta_id, $cantidad]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "Devolución procesada correctamente. Stock actual: " . $result['stock'];
        } else {
            echo "Devolución procesada correctamente, pero no se devolvió información adicional.";
        }
    } catch (PDOException $e) {
        echo "Error al procesar devolución: " . $e->getMessage();
    }
}

function aplicarDescuento($pdo, $cliente_id, $porcentaje_descuento) {
    $sql = "CALL aplicar_descuento(?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$cliente_id, $porcentaje_descuento]);
        echo "Descuento aplicado correctamente.";
    } catch (PDOException $e) {
        echo "Error al aplicar descuento: " . $e->getMessage();
    }
}

function generarReporteBajoStock($pdo) {
    $sql = "CALL reporte_bajo_stock()";
    
    try {
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            echo "<h3>Productos con Bajo Stock:</h3>";
            echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Stock</th><th>Cantidad a Reponer</th></tr>";

            foreach ($result as $row) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['nombre']) . "</td>
                        <td>" . htmlspecialchars($row['stock']) . "</td>
                        <td>" . htmlspecialchars($row['cantidad_reposicion']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron productos con bajo stock.";
        }
    } catch (PDOException $e) {
        echo "Error al obtener reporte: " . $e->getMessage();
    }
}

function calcularComisiones($pdo, $criterio) {
    $sql = "CALL calcular_comisiones(?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([$criterio]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3>Comisiones por Ventas:</h3>";
        echo "<table border='1'><tr><th>Vendedor ID</th><th>Comisión</th></tr>";

        foreach ($result as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['vendedor_id']) . "</td>
                    <td>$" . number_format($row['comision'], 2) . "</td>
                  </tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Error al calcular comisiones: " . $e->getMessage();
    }
}

registrarVenta($pdo, 1, 1, 2);
obtenerEstadisticasCliente($pdo, 1);
procesarDevolucion($pdo, 1, 1);
aplicarDescuento($pdo, 1, 10); 
generarReporteBajoStock($pdo);
calcularComisiones($pdo, 'monto'); 
?>
