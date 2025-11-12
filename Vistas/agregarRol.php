<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Usuario.php';
include_once __DIR__ . '/../Clases/Rol.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Rol</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
    <div class="accion-box">
        <div class="volverinicio"><a href="../Vistas/paginaInicio.php">Volver a Inicio</a></div>
    </div></div> 

    <div class="main-content">
    <div class="form-box">
        <p>Agregar Rol</p>
        
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $nombre = $_POST['nombre'];
                $rol = new Rol($nombre);
                $rol_registrada = $rol->verificarRol($bd);

                if($rol_registrada){
                    echo "El rol ya esta registrado. Intenta con otro.";
                }else{
                    $rol->subirRol($bd);
                    echo "Rol cargada con exito";
                }
            }
        ?>
        <form action="agregarRol.php" method="post">
            <label for="nombre">Nombre de la marca:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <input type="submit" value="Agregar">
        </form>
    </div></div>
</body>
</html>
