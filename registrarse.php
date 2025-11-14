<?php
session_start();
include_once "DataBase.php";     
include_once "Clases/Usuario.php";
include_once "Clases/Rol.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $clave = $_POST["clave"];
    $clave2 = $_POST["clave2"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $id_rol = $_POST["rol"];

    $usuario = new Usuario($email, $clave, $nombre, $apellido );
    
    if ($usuario->buscarUsuario($bd,$email)) {
        $error='Ya hay un usuario registrado con este correo, intente con otro.';
    } else if ($clave<>$clave2){
         $error='Las contraseñas no coinciden, intentelo nuevamente.';
    } else {
        $usuario->subirUsuario($bd, $email, $clave, $nombre, $apellido, $id_rol);
        header("Location: Vistas/paginaInicio.php"); 
        exit;
    }
}

$roles = Rol::obtenerRol($bd); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="CSS/registrarse.css">
</head>
<body>
 
  <div class="col-izquierda">
      <h5 class="sistema">FREE-<br>STOCK</h5>
      <div class="contenedor-imagen">
          <img class="imagen" src="../CSS/imagenes/gestion-de-stock.png" alt="">
      </div>
  </div>

  <div class="form-wrapper">
      <form method="POST" class="form-login">
            <a href="index.php">Volver</a>
            <h1 class="titulo">Ingresa los datos de tu cuenta</h1>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <input type="password" name="clave2" placeholder="Verificar contraseña" required>
            <select name="rol" id="rol" required>
                <option value="">Seleccione Rol</option>
                <?php 
                    foreach($roles as $r){
                        if($r['nombre']!="administrador"){
                            echo '<option value="'.$r['id_rol'].'">'.$r['nombre'].'</option>';
                        }
                    } 
                ?>
                </select>
                <button type="submit">Ingresar</button>
                <?php 
                    if (isset($error)){
                        echo'<p style="color:red;">'.$error.'</p>';
                    }
                ?>
      </form>
      
  </div>


</body>
</html>
