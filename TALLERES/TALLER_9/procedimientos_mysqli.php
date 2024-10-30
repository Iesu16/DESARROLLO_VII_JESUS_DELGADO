<?php
require_once "config_mysqli.php";

function registrarVenta($conn, $cliente_id, $producto_id, $cantidad) {
    $query = "CALL sp_registrar_venta(?, ?, ?, @venta_id)";
    $stmt = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($stmt, "iii", $cliente_id, $producto_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_query($conn, "SELECT @venta_id as venta_id");
        $row = mysqli_fetch_assoc($result);
        
        echo "Venta registrada con éxito. ID de venta: " . $row['venta_id'];
    } catch (Exception $e) {
        echo "Error al registrar la venta: " . $e->getMessage();
    } finally {
        mysqli_stmt_close($stmt);
    }
}

function obtenerEstadisticasCliente($conn, $cliente_id) {
    $query = "CALL sp_estadisticas_cliente(?)";
    $stmt = mysqli_prepare($conn, $query);
    
    mysqli_stmt_bind_param($stmt, "i", $cliente_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $estadisticas = mysqli_fetch_assoc($result);
        
        echo "<h3>Estadísticas del Cliente</h3>";
        echo "Nombre: " . $estadisticas['nombre'] . "<br>";
        echo "Membresía: " . $estadisticas['nivel_membresia'] . "<br>";
        echo "Total compras: " . $estadisticas['total_compras'] . "<br>";
        echo "Total gastado: $" . $estadisticas['total_gastado'] . "<br>";
        echo "Promedio de compra: $" . $estadisticas['promedio_compra'] . "<br>";
        echo "Últimos productos: " . $estadisticas['ultimos_productos'] . "<br>";
    } else {
        echo "Error al obtener estadísticas: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

function procesarDevolucion($conn, $venta_id, $cantidad) {
    $sql = "CALL procesar_devolucion(?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $venta_id, $cantidad);
    
    try {
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "Devolución procesada correctamente. Stock actual: " . $row['stock'];
        } else {
            echo "Devolución procesada correctamente, pero no se devolvió información adicional.";
        }
    } catch (Exception $e) {
        echo "Error al procesar devolución: " . $e->getMessage();
    } finally {
        mysqli_stmt_close($stmt);
    }
}

function aplicarDescuento($conn, $cliente_id, $porcentaje_descuento) {
    $sql = "CALL aplicar_descuento(?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "id", $cliente_id, $porcentaje_descuento);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Descuento aplicado correctamente.";
    } else {
        echo "Error al aplicar descuento: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

function generarReporteBajoStock($conn) {
    $sql = "CALL reporte_bajo_stock()";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error al obtener reporte: " . mysqli_error($conn));
    }

    echo "<h3>Productos con Bajo Stock:</h3>";
    echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Stock</th><th>Cantidad a Reponer</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['stock']}</td>
                <td>{$row['cantidad_reposicion']}</td>
              </tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function calcularComisiones($conn, $criterio) {
    $sql = "CALL calcular_comisiones(?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $criterio);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        echo "<h3>Comisiones por Ventas:</h3>";
        echo "<table border='1'><tr><th>Vendedor ID</th><th>Comisión</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['vendedor_id']}</td>
                    <td>$" . number_format($row['comision'], 2) . "</td>
                  </tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
    } else {
        echo "Error al calcular comisiones: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

registrarVenta($conn, 1, 1, 2);
obtenerEstadisticasCliente($conn, 1);
procesarDevolucion($conn, 1, 1);
aplicarDescuento($conn, 1, 10); 
generarReporteBajoStock($conn);
calcularComisiones($conn, 'monto'); 

mysqli_close($conn);
?>
