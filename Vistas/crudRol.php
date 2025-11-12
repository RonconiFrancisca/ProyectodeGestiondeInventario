<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Rol.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_rol = $_POST['id_rol'];
    Rol::eliminarRol($bd,$id_rol);
}

$rol = Rol::obtenerRol($bd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link rel="stylesheet" href="../CSS/rol.css">
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
            <h1>Roles</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <a href="../Vistas/agregarRol.php">Agregar Rol</a>
                        </div>
                    </div>
                </div>
       
                <form id="rol"  action="crudRol.php" method="post">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        <?php
                            if($rol){
                                foreach($rol as $r){
                                    echo '<tr><td>'.$r["id_rol"].'</td><td>'.$r["nombre"].'</td>
                                    <td><button name="id_rol" type="submit" value="'.$r["id_rol"].'"class="eliminar">Eliminar</button>
                                    <button name="id_rol" type="submit" value="'.$r["id_rol"].'"class="editar">Editar</button></td></tr>';
                                }
                            }else{
                                echo '<p>No hay rol registradas</p>';
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>