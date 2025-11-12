<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Proveedor.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_proveedor = $_POST['id_proveedor'];
    Proveedor::eliminarProveedor($bd,$id_proveedor);
}

$proveedor = Proveedor::obtenerProveedor($bd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="../CSS/proveedor.css">
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
            <h1>Proveedores</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <a href="../Vistas/agregarProveedores.php">Agregar Proveedor</a>
                        </div>
                    </div>
                </div>
        
                <form action="../Vistas/crudProveedor.php" method="post">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Cuit</th>
                            <th>Acciones</th>
                        </tr>
                        <?php 
                            foreach($proveedor as $p){
                                echo '<tr><td>'. $p["id_proveedor"] .'</td><td>'. $p["nombre"] .'</td>
                                <td>'. $p["telefono"] .'</td><td>'. $p["direccion"] .'</td><td>'. $p["cuit"] .'</td><td>
                                <button type="submit" name="id_proveedor" value="'. $p["id_proveedor"] .'"class="eliminar">Eliminar</button>
                                <button type="submit" name="id_proveedor" value="'. $p["id_proveedor"] .'"class="editar">Editar</button></td></tr>';
                            }
                        ?>

                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>