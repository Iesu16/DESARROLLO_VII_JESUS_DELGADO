<?php
require_once "config_mysqli.php";

function mostrarResumenCategorias($conn) {
    $sql = "SELECT * FROM vista_resumen_categorias";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
    }

    echo "<h3>Resumen por Categorías:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Total Productos</th>
            <th>Stock Total</th>
            <th>Precio Promedio</th>
            <th>Precio Mínimo</th>
            <th>Precio Máximo</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['categoria'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['total_productos'] ?? 0) . "</td>";
        echo "<td>" . htmlspecialchars($row['total_stock'] ?? 0) . "</td>";
        echo "<td>$" . number_format($row['precio_promedio'] ?? 0, 2) . "</td>";
        echo "<td>$" . number_format($row['precio_minimo'] ?? 0, 2) . "</td>";
        echo "<td>$" . number_format($row['precio_maximo'] ?? 0, 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarProductosPopulares($conn) {
    $sql = "SELECT * FROM vista_productos_populares LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
    }

    echo "<h3>Top 5 Productos Más Vendidos:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Total Vendido</th>
            <th>Ingresos Totales</th>
            <th>Compradores Únicos</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['producto'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['categoria'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['total_vendido'] ?? 0) . "</td>";
        echo "<td>$" . number_format($row['ingresos_totales'] ?? 0, 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['compradores_unicos'] ?? 0) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarProductosBajoStock($conn) {
    $sql = "SELECT * FROM vista_productos_bajo_stock";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
    }

    echo "<h3>Productos con Bajo Stock:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Stock</th>
            <th>Total Vendido</th>
            <th>Stock Disponible</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>{$row['stock']}</td>";
        echo "<td>{$row['total_vendido']}</td>";
        echo "<td>{$row['stock_disponible']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarHistorialClientes($conn) {
    $sql = "SELECT * FROM vista_historial_clientes";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
    }

    echo "<h3>Historial Completo de Clientes:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['cliente']) . "</td>";
        echo "<td>" . htmlspecialchars($row['producto']) . "</td>";
        echo "<td>{$row['cantidad']}</td>";
        echo "<td>$" . number_format($row['precio_unitario'], 2) . "</td>";
        echo "<td>$" . number_format($row['total'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

function mostrarMetricasPorCategoria($conn) {
    $sql = "
    SELECT c.categoria,
           COUNT(p.id) AS total_productos,
           SUM(v.monto) AS ventas_totales,
           (SELECT nombre 
            FROM productos 
            WHERE categoria_id = c.id 
            ORDER BY total_vendido DESC 
            LIMIT 1) AS producto_mas_vendido
    FROM categorias c
    LEFT JOIN productos p ON c.id = p.categoria_id
    LEFT JOIN ventas v ON p.id = v.producto_id
    GROUP BY c.categoria
    ";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("ERROR: Could not execute $sql. " . mysqli_error($conn));
    }

    echo "<h3>Métricas de Rendimiento por Categoría:</h3>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Categoría</th>
            <th>Total Productos</th>
            <th>Ventas Totales</th>
            <th>Producto Más Vendido</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
        echo "<td>{$row['total_productos']}</td>";
        echo "<td>$" . number_format($row['ventas_totales'], 2) . "</td>";
        echo "<td>" . htmlspecialchars($row['producto_mas_vendido']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}


mostrarResumenCategorias($conn);
mostrarProductosPopulares($conn);
mostrarProductosBajoStock($conn);
mostrarHistorialClientes($conn);
mostrarMetricasPorCategoria($conn);

mysqli_close($conn);
?>