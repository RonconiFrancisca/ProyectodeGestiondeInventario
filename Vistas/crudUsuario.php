<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Usuario.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_usuario = $_POST['id_usuario'];
    Usuario::eliminarUsuario($bd, $id_usuario);
}

$usuario = Usuario::obtenerUsuario($bd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../CSS/usuario.css">
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
            <h1>Usuarios</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <a href="../Vistas/agregarUsuario.php">Agregar Usuario</a>
                        </div>
                    </div>
                </div>
       
        <form id="usuario" action="crudUsuario.php" method="post">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                <?php
                    if($usuario && count($usuario) > 0){
                        foreach($usuario as $u){
                            echo '<tr>
                                    <td>'.$u["id_usuario"].'</td><td>'.$u["email"].'</td>
                                    <td>'.$u["nombre"].'</td><td>'.$u["apellido"].'</td>
                                    <td>'.$u["id_rol"].'</td><td>
                                    <button name="id_usuario" type="submit" value="'.$u["id_usuario"].'" class="eliminar">Eliminar</button>
                                    <button name="id_usuario" type="submit" value="'.$u["id_usuario"].'" class="editar">Editar</button></td>
                                </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align:center;">No hay usuarios registrados</td></tr>';
                    }
                ?>
            </table>
        </form>
    </div>
</body>
</html>
