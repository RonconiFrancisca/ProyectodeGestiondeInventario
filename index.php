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
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="CSS/index.css">
</head>
<body>
  <form method="POST" class="form-login">
    <h2>Iniciar sesión</h2>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="password" name="clave" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
    <?php if (isset($error)): ?>
      <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
  </form>
</body>
</html>
