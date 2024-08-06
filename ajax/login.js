$('#formLogin').submit(function(e) {
    e.preventDefault();

    let username = $.trim($('#username').val());
    let password = $.trim($('#password').val());

    if (username.length == 0 || password.length == 0) {
        Swal.fire({
            icon: "warning",
            title: "Campos Incompletos",
            text: "Ingrese los campos requeridos para ingresar",
        });
    } else {
        $(this).attr('action', 'usuario/login');

        this.submit();
    }
});
