<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Movimiento.php';

$movimientos = Movimiento::obtenerMovimientos($bd);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Movimientos</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div>
        <h2>Historial de Movimientos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Movimiento</th>
                    <th>Producto</th>
                    <th>Código Producto</th>
                    <th>Usuario</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($movimientos as $m) {
                    $tipo = $m['ingreso'] ? 'Entrada' : 'Salida';
                    $codigo = isset($m['codigo_producto']) ? $m['codigo_producto'] : 'N/A';
                    echo "<tr>
                        <td>{$m['id_movimiento']}</td>
                        <td>{$m['nombre_producto']}</td>
                        <td>{$codigo}</td>
                        <td>{$m['nombre_usuario']}</td>
                        <td>{$m['cantidad']}</td>
                        <td>{$tipo}</td>
                        <td>{$m['fecha']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
