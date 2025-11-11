<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Marca.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Marca</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
    <div class="accion-box">
        <div class="volverinicio"><a href="../inicio/paginaInicio.php">Volver a Inicio</a></div>
    </div></div> 

    <div class="main-container">
    <div class="form-box">
        <p>Agregar Marca</p>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $nombre = $_POST['nombre'];
                $marca = new Marca($nombre);
                $marca_registrada = $marca->verificarMarca($bd);

                if($marca_registrada){
                    echo "La marca ya esta registrada. Intenta con otro nombre";
                }else{
                    $marca->subirMarca($bd);
                    echo "Marca cargada con exito";
                }
            }
        ?>
        <form action="agregarMarca.php" method="post">
            <label for="nombre">Nombre de la marca:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <input type="submit" value="Agregar">
        </form>
    </div></div>

</body>
</html>