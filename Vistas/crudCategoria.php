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
    <link rel="stylesheet" href="../CSS/sistema.css">

</head>
<body>
    
    <div>
        <div class="acciones">
            <div class="accion-box">
                <a href="../Vistas/agregarCategoria.php">Agregar Categoria</a>
        </div></div>
        <form id="categoria"  action="crudCategoria.php" method="post">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                </tr>
                <?php
                    if($categoria){
                        foreach($categoria as $c){
                            echo '<tr><td>'.$c["id_categoria"].'</td><td>'.$c["nombre"].'</td>
                            <td><button name="id_categoria" type="submit" value="'.$c["id_categoria"].'"class="eliminar">Eliminar</button></td></tr>';
                        }
                    }else{
                        echo '<p>No hay categorias registradas</p>';
                    }
                ?>
            </table>
        </form>
    </div>
</body>
</html>