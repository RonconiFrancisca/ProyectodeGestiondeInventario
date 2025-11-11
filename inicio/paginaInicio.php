<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicio</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <h2>Menú</h2>
        <ul>
            <li><a href="#" data-file="crudInicio.php">Inicio</a></li>
            <li><a href="#" data-file="../Vistas/crudProducto.php">Productos</a></li>
            <li><a href="#" data-file="../Vistas/crudMarca.php">Marcas</a></li>
            <li><a href="#" data-file="../Vistas/crudCategoria.php">Categorías</a></li>
            <li><a href="#" data-file="../Vistas/crudRol.php">Roles</a></li>
            <li><a href="#" data-file="../Vistas/crudUsuario.php">Usuarios</a></li>
            <li><a href="#" data-file="../Vistas/crudProveedor.php">Proveedores</a></li>
            <li><a href="#" data-file="../Stock/historial.php">Historial del stock</a></li>
            <li><a href="#" data-file="../Stock/stock.php">Stock de productos</a></li>
        </ul>
    </nav>

    <div class="main-content" id="content">
        <!-- Aquí se carga crudInicio.php automáticamente -->
    </div>
</div>

<script>
    const links = document.querySelectorAll('.sidebar a');
    const content = document.getElementById('content');

    function loadContent(file) {
        fetch(file)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
            })
            .catch(err => {
                content.innerHTML = `<p>Error al cargar el contenido: ${err}</p>`;
            });
    }

    loadContent('crudInicio.php');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const file = this.dataset.file;
            loadContent(file);
            links.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
</body>
</html>
