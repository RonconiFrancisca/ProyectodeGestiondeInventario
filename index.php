<?php
session_start();
include_once "DataBase.php";     
include_once "Clases/Usuario.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $clave = $_POST["clave"];

    $usuarioObj = new Usuario($email, $clave, '', '');
    $usuarioValido = $usuarioObj->verificarClave($bd, $email, $clave);

    if ($usuarioValido) {
        $_SESSION["usuario"] = [
            "id" => $usuarioValido["id_usuario"],
            "email" => $usuarioValido["email"],
            "nombre" => $usuarioValido["nombre"],
            "apellido" => $usuarioValido["apellido"],
            "id_rol" => $usuarioValido["id_rol"]
        ];

        header("Location:Vistas/paginaInicio.php"); 
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
 
  <div class="col-izquierda">
      <h5 class="sistema">GE-<br>STOCK</h5>
      <div class="contenedor-imagen">
          <img class="imagen" src="../CSS/imagenes/gestion-de-stock.png" alt="">
      </div>
  </div>

  <div class="form-wrapper">
      <form method="POST" class="form-login">
          <h1 class="titulo">Iniciar sesión</h1>
          <input type="email" name="email" placeholder="Correo electrónico" required>
          <input type="password" name="clave" placeholder="Contraseña" required>
          <button type="submit">Ingresar</button>
            <?php if (isset($error)){
                    echo '<p style="color:red;">'.$error.'</p>';
                    } 
            ?>
             <p>¿No tenes una cuenta creada? <a href="registrarse.php">Registrate acá</a></p>
      </form>
  </div>


</body>
</html>
