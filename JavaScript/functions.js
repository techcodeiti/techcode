// Función para mostrar la ventana emergente
function mostrarVentanaEmergente(button) {
    var ventanaEmergente = document.getElementById("ventanaEmergente");
    var fondoSombreado = document.getElementById("fondoSombreado");

    ventanaEmergente.style.display = "block";
    fondoSombreado.style.display = "block";

    //Datos de idVisita y idSolicitud los obtiene dentro del boton.
    
    //detalle_solicitud_cliente.php
    var idVisita = button.getAttribute('data-idvisita');
    var idSolicitud = button.getAttribute('data-idsolicitud');

    document.getElementsByName('IDVISITAPOPUP')[0].value = idVisita;
    document.getElementsByName('IDSOLICITUDPOPUP')[0].value = idSolicitud;
}

function mostrarVentanaSuspension(button) {
    var ventanaEmergente = document.getElementById("ventanaEmergente");
    var fondoSombreado = document.getElementById("fondoSombreado");

    ventanaEmergente.style.display = "block";
    fondoSombreado.style.display = "block";

    //listas_usuarios.php
    var idTecnico = button.getAttribute('data-idtecnico');

    document.getElementsByName('IDTECNICOPOPUP')[0].value = idTecnico;
}

// Función para cerrar la ventana emergente
function cerrarVentanaEmergente() {
    var ventanaEmergente = document.getElementById("ventanaEmergente");
    var fondoSombreado = document.getElementById("fondoSombreado");
    ventanaEmergente.style.display = "none";
    fondoSombreado.style.display = "none";
}

function cerrarVentanaSuspension() {
    var ventanaEmergente = document.getElementById("ventanaEmergente");
    var fondoSombreado = document.getElementById("fondoSombreado");
    ventanaEmergente.style.display = "none";
    fondoSombreado.style.display = "none";
}