$('#registrarUsuarioForm').submit( function (e) {
    e.preventDefault();

    let nombre = $.trim($('#nombre').val());
    let apellidos = $.trim($('#apellido').val());
    let telefono = $.trim($('#telefono').val());
    let dni = $.trim($('#dni').val());
    let usuario = $.trim($('#usuario').val());
    let rol = $.trim($('#selectRol').val());
    let area = $.trim($('#selectAreas').val());
    let password = $.trim($('#password').val());
    let confirm_password = $.trim($('#confirm_password').val());

    if (password != confirm_password){
        Swal.fire({
            icon: "warning",
            title: "Las contraseñas no coninciden",
            text: "Asegurese de ingresar contraseñas que coincidan",
        });
        return
    }

    if(nombre.length == 0 || apellidos.length == 0 || telefono.length == 0 || dni.length == 0
        || usuario.length == 0 || rol.length == 0 || area.length == 0 || password.length == 0 || confirm_password.length == 0){
        Swal.fire({
            icon: "warning",
            title: "Campos Incompletos",
            text: "Ingrese los campos requeridos",
        });
        return;
    }

    $.ajax({
        url: "./controllers/usuario/registrarUsuario.php",
        type: "POST",
        dataType: "json",
        data: {nombre, apellidos, telefono, dni, usuario, rol, area, password},
        success: function (response) {
            if (response.message == '¡Usuario encontrado!'){
                Swal.fire({
                    icon: "error",
                    title: "El usuario que intenta registrar ya se encuentra registrado"
                })
            }else{
                if (response.status == 'success'){
                    Swal.fire({
                        icon: "success",
                        title: "Registro Exitoso",
                        text: "Se registro correctamente el usuario"
                    }).then(() => {
                        $.ajax({
                            url: 'views/usuario/listarUsuario.php',
                            method: 'GET',
                            success: function(data) {
                                $('.main').html(data);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error('Error fetching the content:', textStatus, errorThrown);
                            }
                        });
                    })
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Ocurrio un error al momento de registrar el usuario" + response.message
                    })
                }
            }
         },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
     })
} )