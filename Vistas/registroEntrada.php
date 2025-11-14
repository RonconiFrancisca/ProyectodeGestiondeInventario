<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Movimiento.php';
include_once __DIR__ . '/../Clases/Producto.php'; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['crear_guardar'])){
        $codigo = $_POST['codigo_producto'];
        $cantidad = $_POST['cantidad'];
        
        Movimiento::subirMovimiento($bd, $codigo, $cantidad, true);
        header("Location: registroEntrada.php");
        exit();
    }
}
$productos = Producto::obtenerProducto($bd); 
$entradas = Movimiento::obtenerMovimientosPorTipo($bd, true); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas de Stock</title>
    <link rel="stylesheet" href="../CSS/entrada.css">
    <link rel="stylesheet" href="../CSS/registrarEntrada.css">
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
        <h1>Entradas de Stock</h1>
        <div id="contenido">
            <div class="contenedor-acciones">
                <div class="acciones">
                    <div class="accion-box">
                        <button type="button" class="crear" onclick="abrirVentanaCrear()">Registrar Entrada</button>
                    </div>
                </div>
            </div>

            <table>
                <tr>
                    <th>ID Movimiento</th>
                    <th>Código Producto</th>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>
                <?php
                if ($entradas) {
                    foreach ($entradas as $entrada) {
                        echo '<tr>
                                <td>'.$entrada["id_movimiento"].'</td>
                                <td>'.$entrada["codigo"].'</td>
                                <td>'.$entrada["nombre_producto"].'</td>
                                <td>'.$entrada["cantidad"].'</td>
                                <td>'.$entrada["fecha"].'</td>
                              </tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No hay entradas registradas.</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
    
    <div id="ventanaCrear" class="ventana">
        <div class="ventana_contenido">
            <h2>Registrar Nueva Entrada</h2>
            <form method="post" action="registroEntrada.php">
                <select name="codigo_producto" required>
                    <option value="">Seleccione Producto</option>
                    <?php 
                        foreach($productos as $p){
                            echo '<option value="'.$p['codigo'].'">'.$p['nombre'].' ('.$p['codigo'].')</option>';
                        }
                    ?>
                </select>
                <input type="number" name="cantidad" placeholder="Cantidad de entrada" min="1" required>
                <button type="submit" name="crear_guardar">Guardar</button>
                <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
                </form>
        </div>
    </div>

</div>
<script src="../JS/registrarEntrada.js"></script>
</body>
</html>