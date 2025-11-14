function abrirVentana(btn){
    document.getElementById('ventanaEditar').style.display = "flex";
    document.getElementById('id_rol').value = btn.dataset.id;
    document.getElementById('nombre_nuevo').value = btn.dataset.nombre;
}

function cerrarVentana(){
    document.getElementById('ventanaEditar').style.display = "none";
}

function abrirVentanaCrear(){
    document.getElementById('ventanaCrear').style.display = "flex";
}

function cerrarVentanaCrear(){
    document.getElementById('ventanaCrear').style.display = "none";
}