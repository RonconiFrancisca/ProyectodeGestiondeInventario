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
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div>
        <div class="acciones">
        <div class="accion-box">
            <a href="../Vistas/agregarProveedor.php">Agregar Proveedor</a>
        </div></div>
        
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
            </td></tr>';
        }
        ?>

    </table>
</form>

    </div>
</body>
</html>