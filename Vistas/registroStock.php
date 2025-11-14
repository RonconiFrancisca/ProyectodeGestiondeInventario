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
                <li><a href="../Vistas/crudProducto.php">Productos</a></li>
                <li><a href="../Vistas/crudMarca.php">Marcas</a></li>
                <li><a href="../Vistas/crudCategoria.php">Categorías</a></li>
                <li><a href="../Vistas/crudRol.php">Roles</a></li>
                <li><a href="../Vistas/crudUsuario.php">Usuarios</a></li>
                <li><a href="../Vistas/crudProveedor.php">Proveedores</a></li>
                <li><a href="../Vistas/historialMovimientos.php">Historial de Movimientos</a></li>
                <li><a href="../Vistas/registroStock.php">Stock de productos</a></li>
                <li><a href="../Vistas/registroEntrada.php">Entradas</a></li>
                <li><a href="../Vistas/registroSalida.php">Salidas</a></li>
            </ul>
            <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
        </nav>

        <div class="contenido-principal">
            <h1>Stock de Productos</h1>
            <div id="contenido">
                <table>
                    <tr>
                        <th>Código Producto</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad Actual</th>
                    </tr>
                    <?php
                        if($stock_actual){
                            foreach($stock_actual as $p){
                                echo '<tr>
                                        <td>'.$p["codigo"].'</td>
                                        <td>'.$p["nombre_producto"].'</td>
                                        <td>'.$p["cantidad"].'</td>
                                      </tr>';
                            }
                        } 
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
