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
    <link rel="stylesheet" href="../CSS/stock.css">
</head>
<body>
    <div class="contenedor-general">
        <nav class="barra-lateral">
            <h2>Menú</h2>
            <ul>
                <li><a href="../Vistas/paginaInicio.php">Inicio</a></li>
                <li><a href="../Vistas/crudProducto.php" >Productos</a></li>
                <li><a href="../Vistas/crudMarca.php" >Marcas</a></li>
                <li><a href="../Vistas/crudCategoria.php">Categorías</a></li>
                <li><a href="../Vistas/crudRol.php">Roles</a></li>
                <li><a href="../Vistas/crudUsuario.php">Usuarios</a></li>
                <li><a href="../Vistas/crudProveedor.php">Proveedores</a></li>
                <li><a href="../Stock/historialMovimientos.php">Historial del stock</a></li>
                <li><a href="../Stock/registroStock.php">Stock de productos</a></li>
            </ul>
            <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
        </nav>

        <div>
            <h1>Stock de los Productos</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-entrada">
                            <a href="../Stock/registroEntrada.php">Registrar Entrada</a>
                        </div>
                        <div class="accion-salida">
                            <a href="../Stock/registroSalida.php">Registrar Salida</a>
                        </div>
                    </div>
                </div>
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
                                if (isset($p['codigo_producto']) && !empty($p['codigo_producto'])) {
                                    echo "<tr>
                                    <td>{$p['codigo_producto']}</td>
                                    <td>{$p['nombre_producto']}</td>
                                    <td>{$p['cantidad_actual']}</td>
                                    </tr>";
                                } 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
