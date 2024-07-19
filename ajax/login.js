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
        // Asigna la ruta al atributo action del formulario
        $(this).attr('action', 'usuario/login');

        // Ahora que el action está asignado, envía el formulario
        this.submit();
    }
});
