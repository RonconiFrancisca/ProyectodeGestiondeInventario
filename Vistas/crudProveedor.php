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
    <title>Document</title>
</head>
<body>
    <div>
        <form id="proveedor"  action="crudProveedor.php" method="post">
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Cuit</th>
            </tr>
            <?php
                if($proveedor){
                    foreach($proveedor as $p){
                        echo '<tr><td>'.$p["id_proveedor"].'</td><td>'.$p["nombre"].'</td>
                        <td>'.$p["telefono"].'</td><td>'.$p["direccion"].'</td><td>'.$p["cuit"].'</td>
                        <td><button name="id_proveedor" type="submit" value="'.$p["id_proveedor"].'">Eliminar</button></td></tr>';
                    }
                }else{
                    echo '<p>No hay proveedores registrados</p>';
                }
            ?>
            
        </table>
        </form>
    </div>
</body>
</html>