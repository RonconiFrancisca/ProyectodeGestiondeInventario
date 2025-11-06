<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Usuario.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_usuario = $_POST['id_usuario'];
    Usuario::eliminarUsuario($bd,$id_usuario);
}

$usuario = Usuario::obtenerUsuario($bd);

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
        <form id="usuario"  action="crudUsuario.php" method="post">
        <table>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Rol</th>
                
            </tr>
            <?php
                if($usuario){
                    foreach($usuario as $u){
                        echo '<tr><td>'.$u["id_usuario"].'</td<td>'.$u["email"].'</td>
                        <td>'.$u["nombre"].'</td><td>'.$u["apellido"].'</td><td>'.$u["id_rol"].'</td>
                        <td><button name="id_usuario" type="submit" value="'.$p["id_usuario"].'">Eliminar</button></td></tr>';
                    }
                }else{
                    echo '<p>No hay usuarios registrados</p>';
                }
            ?>
            
        </table>
        </form>
    </div>
</body>
</html>