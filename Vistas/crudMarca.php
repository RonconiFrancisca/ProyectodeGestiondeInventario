<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Marca.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['eliminar'])){
        $id_marca = $_POST['eliminar']; 
        Marca::eliminarMarca($bd, $id_marca);
    }

    if(isset($_POST['editar_guardar'])){
        $id_marca = $_POST['id_marca'];
        $nuevo_nombre = $_POST['nuevo_nombre'];
        Marca::editarMarca($bd, $id_marca, $nuevo_nombre);
    }

    if(isset($_POST['crear_guardar'])){
        $marca = new Marca($_POST['nueva_marca']); 
        $marca->subirMarca($bd);
    }
}

$marcas = Marca::obtenerMarca($bd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
    <link rel="stylesheet" href="../CSS/marca.css">
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
            <h1>Marcas</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <button type="button" class="crear" onclick="abrirVentanaCrear()">Agregar Marca</button>
                        </div>
                    </div>
                </div>
        
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php
                        if($marcas){
                            foreach($marcas as $marca){
                                echo '<form id="marca" action="crudMarca.php" method="post">
                                        <tr>
                                            <td>'.$marca["id_marca"].'</td>
                                            <td>'.$marca["nombre"].'</td>
                                            <td>
                                                <button name="eliminar" type="submit" value="'.$marca["id_marca"].'" class="eliminar">Eliminar</button>
                                            </td>
                                            <td>
                                                <button type="button" 
                                                    data-id="'.$marca["id_marca"].'" 
                                                    data-nombre="'.$marca["nombre"].'" 
                                                    class="editar" 
                                                    onclick="abrirVentana(this)">Editar
                                                </button>
                                            </td>
                                        </tr>
                                    </form>';
                            }
                        } else {
                            echo '<tr><td colspan="4"><p>No hay marcas registradas</p></td></tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
        <div id="ventanaEditar" class="ventana">
            <div class="ventana_contenido">
                <h2>Editar Marca</h2>
                <form method="post" action="crudMarca.php">
                    <input type="hidden" name="id_marca" id="id_marca">
                    <input type="text" name="nuevo_nombre" id="nuevo_nombre" placeholder="Nuevo nombre">
                    <button type="submit" name="editar_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentana()">Cancelar</button>
                </form>
            </div>
        </div>

        <div id="ventanaCrear" class="ventana">
            <div class="ventana_contenido">
                <h2>Crear Marca</h2>
                <form method="post" action="crudMarca.php">
                    <input type="text" name="nueva_marca" id="nueva_marca" placeholder="Nueva marca">
                    <button type="submit" name="crear_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="../JS/editarMarca.js"></script>
</body>
</html>
