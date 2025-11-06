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
    <title>Document</title>
</head>
<body>
    <div>
        <form id="producto"  action="crudProducto.php" method="post">
        <table>
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
            </tr>
            <?php
                if($producto){
                    foreach($producto as $p){
                        echo '<tr><td>'.$p["id_producto"].'</td><td>'.$p["codigo"].'</td>
                        <td>'.$p["nombre"].'</td><td>'.$p["descripcion"].'</td><td>'.$p["precio"].'</td>
                        <td><button name="id_producto" type="submit" value="'.$p["id_producto"].'">Eliminar</button></td></tr>';
                    }
                }else{
                    echo '<p>No hay productos registrados</p>';
                }
            ?>
            
        </table>
        </form>
    </div>
</body>
</html>