// Obtener los elementos de la página
var tablaUsuarios = document.getElementById("tabla-usuarios");
var modalEditar = document.getElementById("modal-editar");
var modalEliminar = document.getElementById("modal-eliminar");

// Función para mostrar la modal de editar
function mostrarModalEditar(idUsuario) {
    // Obtener los datos del usuario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var respuesta = JSON.parse(xhr.responseText);
            // Rellenar los campos de la modal con los datos del usuario
            document.getElementById("id-usuario-editar").value = respuesta.id;
            document.getElementById("nombre-completo-editar").value = respuesta.nombre_completo;
            document.getElementById("tipo-documento-editar").value = respuesta.tipo_documento;
            document.getElementById("numero-documento-editar").value = respuesta.numero_documento;
            document.getElementById("correo-electronico-editar").value = respuesta.correo_electronico;
            document.getElementById("telefono-editar").value = respuesta.telefono;
            document.getElementById("contrasena-editar").value = respuesta.contrasena;
            document.getElementById("estado-editar").value = respuesta.estado;
            // Mostrar la modal
            modalEditar.style.display = "block";
        }
    };
    xhr.send("id_usuario=" + idUsuario);
}

// Función para mostrar la modal de eliminar
function mostrarModalEliminar(idUsuario) {
    // Mostrar la modal
    modalEliminar.style.display = "block";
    // Rellenar el campo de ID del usuario
    document.getElementById("id-usuario-eliminar").value = idUsuario;
}

// Función para obtener los datos del usuario
function obtenerDatosUsuario(idUsuario) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var respuesta = JSON.parse(xhr.responseText);
            // Rellenar los campos de la modal con los datos del usuario
            document.getElementById("nombre-completo-editar").value = respuesta.nombre_completo;
            document.getElementById("tipo-documento-editar").value = respuesta.tipo_documento;
            document.getElementById("numero-documento-editar").value = respuesta.numero_documento;
            document.getElementById("correo-electronico-editar").value = respuesta.correo_electronico;
            document.getElementById("telefono-editar").value = respuesta.telefono;
            document.getElementById("contrasena-editar").value = respuesta.contrasena;
            document.getElementById("estado-editar").value = respuesta.estado;
        }
    };
    xhr.send("id_usuario=" + idUsuario);
}

// Agregar eventos de clic a los botones de editar y eliminar
tablaUsuarios.addEventListener("click", function(event) {
    if (event.target.tagName === "BUTTON") {
        var idUsuario = event.target.dataset.idUsuario;
        if (event.target.textContent === "Editar") {
            mostrarModalEditar(idUsuario);
        } else if (event.target.textContent === "Eliminar") {
            mostrarModalEliminar(idUsuario);
        }
    }
});
// Obtener los elementos de la modal de editar
var modalEditarCerrar = document.querySelector("#modal-editar .close");
var modalEditar = document.getElementById("modal-editar");

// Agregar evento de clic para cerrar la modal de editar
modalEditarCerrar.addEventListener("click", function() {
    modalEditar.style.display = "none";
});

// Obtener los elementos de la modal de eliminar
var modalEliminarCerrar = document.querySelector("#modal-eliminar .close");
var modalEliminar = document.getElementById("modal-eliminar");

// Agregar evento de clic para cerrar la modal de eliminar
modalEliminarCerrar.addEventListener("click", function() {
    modalEliminar.style.display = "none";
});

// Agregar evento de clic para enviar el formulario de editar
document.getElementById("editar_usuario").addEventListener("click", function(event) {
    event.preventDefault();
    var idUsuario = document.getElementById("id-usuario-editar").value;
    var nombreCompleto = document.getElementById("nombre-completo-editar").value;
    var tipoDocumento = document.getElementById("tipo-documento-editar").value;
    var numeroDocumento = document.getElementById("numero-documento-editar").value;
    var correoElectronico = document.getElementById("correo-electronico-editar").value;
    var telefono = document.getElementById("telefono-editar").value;
    var contrasena = document.getElementById("contrasena-editar").value;
    var estado = document.getElementById("estado-editar").value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("id_usuario=" + idUsuario + "&nombre_completo=" + nombreCompleto + "&tipo_documento=" + tipoDocumento + "&numero_documento=" + numeroDocumento + "&correo_electronico=" + correoElectronico + "&telefono=" + telefono + "&contrasena=" + contrasena + "&estado=" + estado);
});

// Agregar evento de clic para enviar el formulario de eliminar
document.getElementById("eliminar_usuario").addEventListener("click", function(event) {
    event.preventDefault();
    var idUsuario = document.getElementById("id-usuario-eliminar").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("id_usuario=" + idUsuario);
});
