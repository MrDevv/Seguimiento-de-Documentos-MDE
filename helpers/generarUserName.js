$(document).ready(function() {

    const nombreInput = $('#nombresNuevo');
    const apellidoInput = $('#apellidosNuevo');
    const usuarioInput = $('#usuarioNuevo');

    function quitarTildes(texto) {
        const acentos = {
            'á': 'a', 'é': 'e', 'í': 'i', 'ó': 'o', 'ú': 'u',
            'Á': 'A', 'É': 'E', 'Í': 'I', 'Ó': 'O', 'Ú': 'U'
        };
        return texto.split('').map(letra => acentos[letra] || letra).join('');
    }

    function generarUsuario() {
        const nombre = nombreInput.val().trim();
        const apellidos = apellidoInput.val().trim().split(' ');

        if (nombre && apellidos.length >= 2) {
            const primerNombreLetra = nombre.charAt(0).toLowerCase();
            const primerApellido = quitarTildes(apellidos[0].toLowerCase());
            const segundoApellidoLetra = quitarTildes(apellidos[1].charAt(0).toLowerCase());

            usuarioInput.val(primerNombreLetra + primerApellido + segundoApellidoLetra);
        } else {
            usuarioInput.val('');
        }
    }

    nombreInput.on('input', generarUsuario);
    apellidoInput.on('input', generarUsuario);
});
