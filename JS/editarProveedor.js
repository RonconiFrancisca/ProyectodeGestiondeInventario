function abrirVentana(btn) {
    document.getElementById("ventanaEditar").style.display = "flex";
    document.getElementById("id_proveedor").value = btn.dataset.id;
    document.getElementById("nombre_nuevo").value = btn.dataset.nombre;
    document.getElementById("telefono_nuevo").value = btn.dataset.telefono;
    document.getElementById("direccion_nueva").value = btn.dataset.direccion;
    document.getElementById("cuit_nuevo").value = btn.dataset.cuit;
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