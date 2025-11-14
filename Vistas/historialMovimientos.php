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
    <link rel="stylesheet" href="../CSS/movimientos.css">
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
                <li><a href="../Vistas/historialMovimientos.php">Historial de Movimientos</a></li>
                <li><a href="../Vistas/registroStock.php">Stock de productos</a></li>
                <li><a href="../Vistas/registroEntrada.php">Entradas</a></li>
                <li><a href="../Vistas/registroSalida.php">Salidas</a></li>
            </ul>
            <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
        </nav>
        <div class="contenido-principal">
            <h1>Historial de Movimientos</h1>
            <div class="contenido">
                <form action="PDFhistorial.php" method="post" target="_blank">
                    <button type="submit">Generar PDF</button>
                </form>
                <table>
                    <tr>
                        <th>ID Movimiento</th>
                        <th>Código Producto</th>
                        <th>Nombre Producto</th>
                        <th>Cantidad</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    if ($movimientos) {
                        foreach ($movimientos as $m) {
                            $tipo = $m['ingreso'] ? 'Entrada' : 'Salida';
                            echo '<tr>
                                    <td>'.$m["id_movimiento"].'</td>
                                    <td>'.$m["codigo"].'</td>
                                    <td>'.$m["nombre_producto"].'</td>
                                    <td>'.$m["cantidad"].'</td>
                                    <td>'.$tipo.'</td>
                                    <td>'.$m["fecha"].'</td>
                                    <td>$'.number_format($m["precio"], 2).'</td>
                                    <td>$'.number_format($m["total"], 2).'</td>
                                </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">No hay movimientos registrados</td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>    
    </div>
</body>
</html>
