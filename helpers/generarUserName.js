$(document).ready(function() {

    const nombreInput = $('#nombresNuevo');
    const apellidoInput = $('#apellidosNuevo');
    const usuarioInput = $('#usuarioNuevo');

    console.log(nombreInput)
    console.log(apellidoInput)
    console.log(usuarioInput)

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

    nombreInput.on('input', generarUsuario);
    apellidoInput.on('input', generarUsuario);
});

