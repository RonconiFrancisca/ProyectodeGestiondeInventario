<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION["usuario"];
?>
<div>
  <h1>Bienvenido, <?= htmlspecialchars($usuario["nombre"]) ?> <?= htmlspecialchars($usuario["apellido"]) ?>!</h1>
  <a href="../inicio/logout.php" class="logout-btn">Cerrar sesión</a>
</div>
