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
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div>
        <div class="acciones">
        <div class="accion-box">
            <a href="../Vistas/agregarRol.php">Agregar Rol</a>
        </div></div>
       
        <form id="rol"  action="crudRol.php" method="post">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                </tr>
                <?php
                    if($rol){
                        foreach($rol as $r){
                            echo '<tr><td>'.$r["id_rol"].'</td><td>'.$r["nombre"].'</td>
                            <td><button name="id_rol" type="submit" value="'.$r["id_rol"].'"class="eliminar">Eliminar</button></td></tr>';
                        }
                    }else{
                        echo '<p>No hay rol registradas</p>';
                    }
                ?>
            
            </table>
        </form>
    </div>
</body>
</html>