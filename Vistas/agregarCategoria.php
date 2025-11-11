<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Categoria.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Categoria</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
    <div class="accion-box">
        <div class="volverinicio"><a href="../inicio/paginaInicio.php">Volver a Inicio</a></div>
    </div></div>
    
    <div class="main-container">
    <div class="form-box">
        <p>Agregar Categoria</p>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $nombre = $_POST['nombre'];
                $categoria = new Categoria($nombre);
                $categoria_registrada = $categoria->verificarCategoria($bd);

                if($categoria_registrada){
                    echo "La categoria ya esta registrada. Intenta con otro nombre";
                }else{
                    $categoria->subirCategoria($bd);
                    echo "Categoria cargada con exito";
                }
            }
        ?>
        <form action="agregarCategoria.php" method="post">
            <label for="nombre">Nombre de la categoria:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>
            <input type="submit" value="Agregar">
        </form>
    </div></div>

</body>
</html>