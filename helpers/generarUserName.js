$(document).ready(function() {

    // Referencias a los elementos del DOM
    const nombreInput = $('#nombre');
    const apellidoInput = $('#apellido');
    const usuarioInput = $('#usuario'); // Asegúrate de que este ID es el correcto para el campo de usuario

    function generarUsuario() {
        const nombre = nombreInput.val().trim();
        const apellidos = apellidoInput.val().trim().split(' ');

        if (nombre && apellidos.length >= 2) {
            const primerNombreLetra = nombre.charAt(0).toLowerCase();
            const primerApellido = apellidos[0].toLowerCase();
            const segundoApellidoLetra = apellidos[1].charAt(0).toLowerCase();

            usuarioInput.val(primerNombreLetra + primerApellido + segundoApellidoLetra);
        } else {
            usuarioInput.val('');
        }
    }

    // Asignar el evento input a los campos de nombre y apellido
    nombreInput.on('input', generarUsuario);
    apellidoInput.on('input', generarUsuario);
});

