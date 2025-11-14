function abrirVentana(btn) {
    document.getElementById("ventanaEditar").style.display = "flex";
    document.getElementById("id_usuario").value = btn.dataset.id;
    document.getElementById("email_nuevo").value = btn.dataset.email;
    document.getElementById("nombre_nuevo").value = btn.dataset.nombre;
    document.getElementById("apellido_nuevo").value = btn.dataset.apellido;
    // Selecciona el rol correcto en el dropdown
    document.getElementById("rol_nuevo").value = btn.dataset.rol; 
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