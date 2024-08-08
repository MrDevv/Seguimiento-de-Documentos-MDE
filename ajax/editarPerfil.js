$(document).ready(function() {
    $(document).off("click", "#btnEditarPerfil").on("click", "#btnEditarPerfil", function(e){
        e.preventDefault();
        let modalEditarPerfil = $("#modalEditarPerfil");

        $("#editarPerfilForm").trigger("reset");

        $.ajax({
            url: "./controllers/usuario/obtenerDatosUsuarioLogeado.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                let {data} = response;

                $('#codPersonaEditarPerfil').val(data[0].codPersona)
                $('#codUsuarioEditarPerfil').val(data[0].codUsuario)
                $('#nombresEditarPerfil').val(data[0].nombres)
                $('#apellidosEditarPerfil').val(data[0].apellidos)
                $('#telefonoEditarPerfil').val(data[0].telefono)
                $('#dniEditarPerfil').val(data[0].dni)
                $('#usuarioEditarPerfil').val(data[0].nombreUsuario)
                $('#usuarioEditarPerfil').val(data[0].nombreUsuario)
                $('#rolEditarPerfil').val(data[0].rol)
                $('#areaEditarPerfil').val(data[0].area)

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })

        modalEditarPerfil.modal({
            backdrop: 'static',
            keyboard: false
        }).modal('show');

    })

    $(document).off("submit", "#editarPerfilForm").on("submit", "#editarPerfilForm", function(e) {
        e.preventDefault()

        let codPersona =  $('#codPersonaEditarPerfil').val()
        let codUsuario =  $('#codUsuarioEditarPerfil').val()
        let nombres =  $('#nombresEditarPerfil').val()
        let apellidos = $('#apellidosEditarPerfil').val()
        let telefono = $('#telefonoEditarPerfil').val()
        let dni = $('#dniEditarPerfil').val()
        let password = $('#passwordEditarPerfil').val()
        let confirm_password = $('#confirmarPasswordEditarPerfil').val()

        if ((password.length > 0 && confirm_password.length == 0) || (password.length == 0 && confirm_password.length > 0) ){
            Swal.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Para actualizar su contraseña debe ingresar los campos 'Contraseña' y 'Confirmar contraseña'"
            })
            return;
        }

        if (password !== confirm_password){
            Swal.fire({
                icon: "warning",
                title: "Advertencia",
                text: "Las contraseñas no coinciden"
            })
            return;
        }

        if (password == ''){
            password = null;
        }

        $.ajax({
            url: "./controllers/usuario/actualizarPerfilUsuario.php",
            type: "POST",
            dataType: "json",
            data: {codPersona, codUsuario, nombres, apellidos, telefono, dni, password},
            success: function (response) {
                let {status, message} = response;
                if (status === 'success'){
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: message
                    }).then(() => {
                        $('#modalEditarPerfil').modal('hide');
                    })
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message + response.info
                    })
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })

    })
})