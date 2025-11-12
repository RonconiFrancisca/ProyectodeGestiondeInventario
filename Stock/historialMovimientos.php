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
                <li><a href="../Stock/historialMovimientos.php">Historial del stock</a></li>
                <li><a href="../Stock/registroStock.php">Stock de productos</a></li>
            </ul>
            <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
        </nav>

        <div>
            <h1>Historial de Movimientos</h1>
            <div id="contenido">
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
                                echo "<tr><td>{$m['id_movimiento']}</td><td>{$m['nombre_producto']}</td>
                                <td>{$codigo}</td><td>{$m['nombre_usuario']}</td><td>{$m['cantidad']}</td>
                                <td>{$tipo}</td><td>{$m['fecha']}</td>
                                </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>   
        </div>  
    </div>
</body>
</html>
