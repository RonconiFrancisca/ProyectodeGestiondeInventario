<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Marca.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_marca = $_POST['id_marca'];
    Marca::eliminarMarca($bd,$id_marca);
}

$marcas = Marca::obtenerMarca($bd);

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
        <form id="marca"  action="crudMarca.php" method="post">
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
            </tr>
            <?php
                if($marcas){
                    foreach($marcas as $marca){
                        echo '<tr><td>'.$marca["id_marca"].'</td><td>'.$marca["nombre"].'</td>
                        <td><button name="id_marca" type="submit" value="'.$marca["id_marca"].'">Eliminar</button></td></tr>';
                    }
                }else{
                    echo '<p>No hay marcas registradas</p>';
                }
            ?>
            
        </table>
        </form>
    </div>
</body>
</html>