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

    console.log({nombre, apellidos, rol, telefono, dni, usuario, area, password, confirm_password})

    if(nombre.length == 0 || apellidos.length == 0 || telefono.length == 0 || dni.length == 0
        || usuario.length == 0 || rol.length == 0 || rea.length == 0 || password.length == 0 || confirm_password.length == 0){
        Swal.fire({
            icon: "warning",
            title: "Campos Incompletos",
            text: "Ingrese los campos requeridos",
        });
        return;
    }

    $.ajax({
        url: "bd/login.php",
        type: "POST",
        dataType: "json",
        data: {usuario, password},
        success: function (data) {
            if (data == "null"){
                Swal.fire({
                    icon: "error",
                    title: "Usuario o password incorrecta"
                })
            }else{
                Swal.fire({
                    icon: "success",
                    title: "Conexión exitosa",
                    confirmButtonText: "guardar",
                }).then((result) => {
                    console.log(result)
                    if (result.value){
                        window.location.href = "vistas/paginaInicio.php"
                    }
                })
            }
        }
    })
} )