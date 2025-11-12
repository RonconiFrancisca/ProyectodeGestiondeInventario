<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Producto.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_producto = $_POST['id_producto'];
    Producto::eliminarProducto($bd,$id_producto);
}

$producto = Producto::obtenerProducto($bd);

?>

<!DOCTYPE html>
<html lang="en">
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
            <h1>Productos</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <a href="../Vistas/agregarProducto.php">Agregar Producto</a>
                        </div>
                    </div>
                </div>
            
                <form id="producto"  action="crudProducto.php" method="post">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                        <?php
                            if($producto){
                                foreach($producto as $p){
                                    echo '<tr><td>'.$p["id_producto"].'</td><td>'.$p["codigo"].'</td>
                                    <td>'.$p["nombre"].'</td><td>'.$p["descripcion"].'</td><td>'.$p["precio"].'</td>
                                    <td><button name="id_producto" type="submit" value="'.$p["id_producto"].'"class="eliminar">Eliminar</button>
                                    <button name="id_producto" type="submit" value="'.$p["id_producto"].'"class="editar">Editar</button></td></tr>';
                                }
                            }else{
                                echo '<p>No hay productos registrados</p>';
                            }
                        ?>
                    
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>