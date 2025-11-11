<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Stock.php';

$stock_actual = Stock::obtenerStockActual($bd);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Actual</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
        <div class="accion-box"><a href="../Stock/registroEntrada.php">Registrar Entrada</a></div>
        <div class="accion-box"><a href="../Stock/registroSalida.php">Registrar Salida</a></div>
    </div>
    <div>
        <h2>Stock Actual por Producto</h2>
        <table>
            <thead>
                <tr>
                    <th>Código Producto</th>
                    <th>Nombre</th>
                    <th>Cantidad Actual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stock_actual as $p) {
                    // Evitar warning si 'codigo_producto' no existe
                    $codigo = isset($p['codigo_producto']) ? $p['codigo_producto'] : 'N/A';
                    echo "<tr>
                        <td>{$codigo}</td>
                        <td>{$p['nombre_producto']}</td>
                        <td>{$p['cantidad_actual']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
