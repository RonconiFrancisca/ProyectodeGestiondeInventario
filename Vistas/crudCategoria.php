<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Categoria.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_categoria = $_POST['id_categoria'];
    Categoria::eliminarCategoria($bd,$id_categoria);
}

$categoria = Categoria::obtenerCategoria($bd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link rel="stylesheet" href="../CSS/categoria.css">
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
            <h1>Categorias</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <a href="../Vistas/agregarCategoria.php">Agregar Categoria</a>
                        </div>
                    </div>
                </div>
                <form id="categoria"  action="crudCategoria.php" method="post">
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        <?php
                            if($categoria){
                                foreach($categoria as $c){
                                    echo '<tr><td>'.$c["id_categoria"].'</td><td>'.$c["nombre"].'</td>
                                    <td><button name="id_categoria" type="submit" value="'.$c["id_categoria"].'"class="eliminar">Eliminar</button>
                                    <button name="id_categoria" type="submit" value="'.$c["id_categoria"].'"class="editar">Editar</button></td></tr>';
                                }
                            }else{
                                echo '<p>No hay categorias registradas</p>';
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>