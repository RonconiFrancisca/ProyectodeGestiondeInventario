<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Producto.php';
include_once __DIR__.'/../Clases/Marca.php';
include_once __DIR__.'/../Clases/Categoria.php';
include_once __DIR__.'/../Clases/Proveedor.php'; 

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['eliminar'])){
        $id_producto = $_POST['eliminar'];
        Producto::eliminarProducto($bd, $id_producto);
    }

    if(isset($_POST['editar_guardar'])){
        $id_producto = $_POST['id_producto'];
        $codigo_nuevo = $_POST['codigo_nuevo'];
        $nombre_nuevo = $_POST['nombre_nuevo'];
        $descripcion_nuevo = $_POST['descripcion_nuevo'];
        $precio_nuevo = $_POST['precio_nuevo'];
        $id_marca_nueva = $_POST['marca_nueva'];
        $id_categoria_nueva = $_POST['categoria_nueva'];
        $id_proveedor_nuevo = $_POST['proveedor_nueva']; 

        Producto::editarProducto(
            $bd,
            $id_producto,
            $codigo_nuevo,
            $nombre_nuevo,
            $descripcion_nuevo,
            $precio_nuevo,
            $id_marca_nueva,
            $id_categoria_nueva,
            $id_proveedor_nuevo 
        );
    }

    if(isset($_POST['crear_guardar'])){
        $nuevo_codigo = $_POST['nuevo_codigo'];
        $nuevo_nombre = $_POST['nuevo_nombre'];
        $nueva_descripcion = $_POST['nueva_descripcion'];
        $nuevo_precio = $_POST['nuevo_precio'];
        $nueva_marca = $_POST['nueva_marca'];
        $nueva_categoria = $_POST['nueva_categoria'];
        $nuevo_proveedor = $_POST['nuevo_proveedor']; 

        Producto::subirProducto(
            $bd,
            $nuevo_codigo,
            $nuevo_nombre,
            $nueva_descripcion,
            $nuevo_precio,
            $nueva_marca,
            $nueva_categoria,
            $nuevo_proveedor 
        );
    }
}

$producto = Producto::obtenerProductosConDetalles($bd);
$marcas = Marca::obtenerMarca($bd);
$categorias = Categoria::obtenerCategoria($bd);
$proveedores = Proveedor::obtenerProveedor($bd); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="../CSS/producto.css">
</head>
<body>
<div class="contenedor-general">
    <nav class="barra-lateral">
        <h2>Menú</h2>
        <ul>
                <li><a href="../Vistas/paginaInicio.php">Inicio</a></li>
                <li><a href="../Vistas/crudProducto.php">Productos</a></li>
                <li><a href="../Vistas/registroEntrada.php">Entradas</a></li>
                <li><a href="../Vistas/registroSalida.php">Salidas</a></li>
                <li><a href="../Vistas/crudMarca.php">Marcas</a></li>
                <li><a href="../Vistas/crudCategoria.php">Categorías</a></li>
                <li><a href="../Vistas/crudRol.php">Roles</a></li>
                <li><a href="../Vistas/crudUsuario.php">Usuarios</a></li>
                <li><a href="../Vistas/crudProveedor.php">Proveedores</a></li>
                <li><a href="../Vistas/historialMovimientos.php">Historial de Movimientos</a></li>
                <li><a href="../Vistas/registroStock.php">Stock de productos</a></li>
                <li><a href="../Vistas/producto_proveedor.php">Producto/Proveedor</a></li>
        </ul>
        <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
    </nav>

    <div class="contenido-principal">
        <h1>Productos</h1>
        <div id="contenido">
            <div class="contenedor-acciones">
                <div class="acciones">
                    <div class="accion-box">
                        <button type="button" class="crear" onclick="abrirVentanaCrear()">Agregar Producto</button>
                    </div>
                </div>
            </div>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th colspan="2">Acciones</th>
                </tr>
                <?php
                    if ($producto) {
                        foreach ($producto as $p) {
                            echo '<tr><td>' . $p['id_producto'] . '</td>
                            <td>' . $p['codigo'] . '</td><td>' . $p['nombre'] . '</td>
                            <td>' . $p['descripcion'] . '</td><td>' . $p['precio'] . '</td>
                            <td>' . $p['marca_nombre'] . '</td>
                            <td>' . $p['categoria_nombre'] . '</td><td>
                                    <form method="post" action="crudProducto.php" style="display:inline;">
                                        <button name="eliminar" type="submit" value="' . $p['id_producto'] . '" class="eliminar">Eliminar</button>
                                    </form>
                                </td>';
                            echo '<td>
                                    <button type="button"
                                        data-id="' . $p['id_producto'] . '"
                                        data-codigo="' . $p['codigo'] . '"
                                        data-nombre="' . $p['nombre'] . '"
                                        data-descripcion="' . $p['descripcion'] . '"
                                        data-precio="' . $p['precio'] . '"
                                        data-marca="' . $p['id_marca'] . '"
                                        data-categoria="' . $p['id_categoria'] . '"
                                        class="editar"
                                        onclick="abrirVentana(this)">
                                        Editar
                                    </button>
                                </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="9"><p>No hay productos registrados</p></td></tr>';
                    }
                    ?>

            </table>
        </div>
    </div>

    <div id="ventanaEditar" class="ventana">
        <div class="ventana_contenido">
            <h2>Editar Producto</h2>
            <form method="post" action="crudProducto.php">
                <input type="hidden" name="id_producto" id="id_producto">
                <input type="text" name="codigo_nuevo" id="codigo_nuevo" placeholder="Código">
                <input type="text" name="nombre_nuevo" id="nombre_nuevo" placeholder="Nombre">
                <input type="text" name="descripcion_nuevo" id="descripcion_nuevo" placeholder="Descripción">
                <input type="number" name="precio_nuevo" id="precio_nuevo" placeholder="Precio" step="0.01">

                <select name="marca_nueva" id="marca_nueva" required>
                    <option value="">Seleccione Marca</option>
                    <?php foreach($marcas as $m){ echo '<option value="'.$m['id_marca'].'">'.$m['nombre'].'</option>'; } ?>
                </select>

                <select name="categoria_nueva" id="categoria_nueva" required>
                    <option value="">Seleccione Categoría</option>
                    <?php foreach($categorias as $c){ echo '<option value="'.$c['id_categoria'].'">'.$c['nombre'].'</option>'; } ?>
                </select>

                <select name="proveedor_nueva" id="proveedor_nueva" required>
                    <option value="">Seleccione Proveedor</option>
                    <?php foreach($proveedores as $prov){ echo '<option value="'.$prov['id_proveedor'].'">'.$prov['nombre'].'</option>'; } ?>
                </select>

                <button type="submit" name="editar_guardar">Guardar</button>
                <button type="button" name="cancelar"  onclick="cerrarVentana()">Cancelar</button>
                </form>
        </div>
    </div>

    <div id="ventanaCrear" class="ventana">
        <div class="ventana_contenido">
            <h2>Crear Producto</h2>
            <form method="post" action="crudProducto.php">
                <input type="text" name="nuevo_codigo" placeholder="Código" required>
                <input type="text" name="nuevo_nombre" placeholder="Nombre" required>
                <input type="text" name="nueva_descripcion" placeholder="Descripción">
                <input type="number" name="nuevo_precio" placeholder="Precio" step="0.01" required>

                <select name="nueva_marca" required>
                    <option value="">Seleccione Marca</option>
                    <?php foreach($marcas as $m){ echo '<option value="'.$m['id_marca'].'">'.$m['nombre'].'</option>'; } ?>
                </select>

                <select name="nueva_categoria" required>
                    <option value="">Seleccione Categoría</option>
                    <?php foreach($categorias as $c){ echo '<option value="'.$c['id_categoria'].'">'.$c['nombre'].'</option>'; } ?>
                </select>
                <select name="nuevo_proveedor" required>
                    <option value="">Seleccione Proveedor</option>
                    <?php foreach($proveedores as $prov){ echo '<option value="'.$prov['id_proveedor'].'">'.$prov['nombre'].'</option>'; } ?>
                </select>

                <button type="submit" name="crear_guardar">Guardar</button>
                <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
            </form>
        </div>
    </div>

</div>

<script src="../JS/editarProducto.js"></script>
</body>
</html>