function abrirVentana(btn) {
    document.getElementById("ventanaEditar").style.display = "flex";
    document.getElementById("id_producto").value = btn.dataset.id;
    document.getElementById("codigo_nuevo").value = btn.dataset.codigo;
    document.getElementById("nombre_nuevo").value =btn.dataset.nombre;
    document.getElementById("descripcion_nuevo").value = btn.dataset.descripcion;
    document.getElementById("precio_nuevo").value = btn.dataset.precio;
    document.getElementById("marca_nueva").value = btn.dataset.marca;
    document.getElementById("categoria_nueva").value = btn.dataset.categoria;
}

function cerrarVentana() {
    document.getElementById("ventanaEditar").style.display = "none";
}

function abrirVentanaCrear() {
    document.getElementById("ventanaCrear").style.display = "flex";
}

function cerrarVentanaCrear() {
    document.getElementById("ventanaCrear").style.display = "none";
}
