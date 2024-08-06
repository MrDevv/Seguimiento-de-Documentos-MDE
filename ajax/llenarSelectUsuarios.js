$(document).ready(function(){
    $.ajax({
        url: './controllers/usuario/listarUsuario.php',
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            let options = `<option value="0">Seleccionar</option>` + // Agregar la opción "Seleccionar"
                response.map(usuario =>
                    `<option value="${usuario.codUsuarioArea}">${usuario.nombres + ' ' + usuario.apellidos}</option>`
                ).join('');

            $('.selectFiltroArea').html(options);
        }
    });
})


