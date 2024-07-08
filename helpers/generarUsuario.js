document.addEventListener('DOMContentLoaded', () => {
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const usuarioInput = document.getElementById('usuario');

    function generarUsuario() {
        const nombre = nombreInput.value.trim();
        const apellidos = apellidoInput.value.trim().split(' ');

        if (nombre && apellidos.length >= 2) {
            const primerNombreLetra = nombre.charAt(0).toLowerCase();
            const primerApellido = apellidos[0].toLowerCase();
            const segundoApellidoLetra = apellidos[1].charAt(0).toLowerCase();

            usuarioInput.value = primerNombreLetra + primerApellido + segundoApellidoLetra;
        } else {
            usuarioInput.value = '';
        }
    }

    nombreInput.addEventListener('input', generarUsuario);
    apellidoInput.addEventListener('input', generarUsuario);
});
