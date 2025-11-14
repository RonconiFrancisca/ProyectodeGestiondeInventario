<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Proveedor.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['eliminar'])){
        $id_proveedor = $_POST['eliminar'];
        Proveedor::eliminarProveedor($bd, $id_proveedor);
    }
    
    if(isset($_POST['editar_guardar'])){
        $id_proveedor = $_POST['id_proveedor'];
        $nombre_nuevo = $_POST['nombre_nuevo'];
        $telefono_nuevo = $_POST['telefono_nuevo'];
        $direccion_nueva = $_POST['direccion_nueva'];
        $cuit_nuevo = $_POST['cuit_nuevo'];
        
        Proveedor::editarProveedor($bd, $id_proveedor, $nombre_nuevo, $telefono_nuevo, $direccion_nueva, $cuit_nuevo);
    }
    
    if(isset($_POST['crear_guardar'])){
        $nuevo_nombre = $_POST['nuevo_nombre'];
        $nuevo_telefono = $_POST['nuevo_telefono']; 
        $nueva_direccion = $_POST['nueva_direccion'];
        $nuevo_cuit = $_POST['nuevo_cuit'];
        
        Proveedor::subirProveedor($bd, $nuevo_nombre, $nuevo_cuit, $nueva_direccion, $nuevo_telefono);
    }
}
$proveedor = Proveedor::obtenerProveedor($bd);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../CSS/proveedor.css">
    <link rel="stylesheet" href="../CSS/editarProveedor.css">
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
            <h1>Proveedores</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <button type="button" class="crear" onclick="abrirVentanaCrear()">Agregar Proveedor</button>
                        </div>
                    </div>
                </div>
            
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Cuit</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php if ($proveedor): ?>
                        <?php foreach($proveedor as $p): ?>
                            <tr>
                                <td><?= $p["id_proveedor"] ?></td>
                                <td><?= $p["nombre"] ?></td>
                                <td><?= $p["telefono"] ?></td>
                                <td><?= $p["direccion"] ?></td>
                                <td><?= $p["cuit"] ?></td>
                                <td>
                                    <form method="post" action="crudProveedor.php" style="display:inline;">
                                        <button name="eliminar" type="submit" value="<?= $p["id_proveedor"] ?>" class="eliminar">Eliminar</button>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" 
                                        data-id="<?= $p["id_proveedor"] ?>" 
                                        data-nombre="<?= $p["nombre"] ?>" 
                                        data-telefono="<?= $p["telefono"] ?>" 
                                        data-direccion="<?= $p["direccion"] ?>" 
                                        data-cuit="<?= $p["cuit"] ?>" 
                                        class="editar" 
                                        onclick="abrirVentana(this)">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7"><p>No hay proveedores registrados</p></td></tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        
        <div id="ventanaEditar" class="ventana">
            <div class="ventana_contenido">
                <h2>Editar Proveedor</h2>
                <form method="post" action="crudProveedor.php">
                    <input type="hidden" name="id_proveedor" id="id_proveedor">
                    <input type="text" name="nombre_nuevo" id="nombre_nuevo" placeholder="Nombre" required>
                    <input type="text" name="telefono_nuevo" id="telefono_nuevo" placeholder="Teléfono" required>
                    <input type="text" name="direccion_nueva" id="direccion_nueva" placeholder="Dirección">
                    <input type="text" name="cuit_nuevo" id="cuit_nuevo" placeholder="CUIT" required>
    
                    <button type="submit" name="editar_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentana()">Cancelar</button>
                </form>
            </div>
        </div>
        
        <div id="ventanaCrear" class="ventana">
            <div class="ventana_contenido">
                <h2>Crear Proveedor</h2>
                <form method="post" action="crudProveedor.php">
                    <input type="text" name="nuevo_nombre" placeholder="Nombre" required>
                    <input type="text" name="nuevo_telefono" placeholder="Teléfono" required>
                    <input type="text" name="nueva_direccion" placeholder="Dirección">
                    <input type="text" name="nuevo_cuit" placeholder="CUIT" required>
    
                    <button type="submit" name="crear_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
                </form>
            </div>
        </div>
        
    </div>

    <script src="../JS/editarProveedor.js"></script>
</body>
</html>