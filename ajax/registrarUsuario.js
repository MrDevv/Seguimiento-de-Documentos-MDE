$('#registrarUsuarioForm').submit( function (e) {
    e.preventDefault();

    let nombre = $.trim($('#nombre').val());
    let apellidos = $.trim($('#apellidos').val());


    // let password =  $.trim($('#password').val());

    if (usuario.length == 0 || password.length == 0){
        Swal.fire({
            icon: "warning",
            title: "Campos Incompletos",
            text: "Ingrese los campos requeridos para ingresar",
        });
    }else{
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
    }
} )