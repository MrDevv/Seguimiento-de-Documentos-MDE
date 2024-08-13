$(document).ready(function(){
    // nuevo Area
    $(document).off("click", "#btnRegistrarArea").on("click", "#btnRegistrarArea", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarArea");
        $("#registrarAreaForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function() {
            $("#descripcionAreaNuevo").focus();
        });
    });

    // registrar Area
    $(document).off('submit', '#registrarAreaForm').on('submit', '#registrarAreaForm', function(e) {
        e.preventDefault();

        let descripcion = $.trim($('#descripcionAreaNuevo').val());

        if (descripcion.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/areas/registrarArea.php",
            type: "POST",
            datatype: "json",
            data: { descripcion: descripcion },
            success: function(response) {
                response = JSON.parse(response);
                if (response.message === 'area encontrada') {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "El área que intenta registrar ya existe"
                    });
                } else {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: response.message
                        }).then(() => {
                            $('#modalRegistrarArea').modal('hide');
                            $.ajax({
                                url: './controllers/areas/listarAreas.php',
                                method: 'GET',
                                dataType: 'json', // Asegúrate de que el servidor responda con JSON
                                data: {pagina: 1, registrosPorPagina: 900},
                                success: function(data) {
                                    if (data && Array.isArray(data)) {
                                        // Construir las opciones para el select
                                        let options = `<option value="0">Seleccionar</option>` + // Agregar la opción "Seleccionar"
                                            data.map(area =>
                                                `<option value="${area.codArea}">${area.descripcion}</option>`
                                            ).join('');

                                        // Actualizar el contenido del select
                                        $('.selectArea').html(options);
                                    } else {
                                        console.warn('No data received or data is not an array.');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error fetching the content:', textStatus, errorThrown);
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message
                        });
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });



    // nuevo Usuario
    $(document).off("click", "#btnRegistrarUsuario").on("click", "#btnRegistrarUsuario", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarUsuario");
        $("#registrarUsuarioForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.one('shown.bs.modal', function() {
            $("#nombresNuevo").focus();
        });
    });

    // registrar Usuario
    $(document).off("submit", "#registrarUsuarioForm").on('submit', '#registrarUsuarioForm', function(e) {
        e.preventDefault();
        let nombre = $.trim($('#nombresNuevo').val());
        let apellidos = $.trim($('#apellidosNuevo').val());
        let telefono = $.trim($('#telefonoNuevo').val());
        let dni = $.trim($('#dniNuevo').val());
        let usuario = $.trim($('#usuarioNuevo').val());
        let rol = $.trim($('#selectRol').val());
        let area = $.trim($('#selectAreas').val());
        let password = $.trim($('#passwordNuevo').val());
        let confirm_password = $.trim($('#passwordConfirmarNuevo').val());

        // Validaciones
        if (password !== confirm_password) {
            Swal.fire({
                icon: "warning",
                title: "Las contraseñas no coinciden",
                text: "Asegúrese de ingresar contraseñas que coincidan",
            });
            return;
        }

        if(nombre.length == 0 || apellidos.length == 0 || telefono.length == 0 || dni.length == 0
            || usuario.length == 0 || rol.length == 0 || area.length == 0 || password.length == 0 || confirm_password.length == 0 || area == "0"){
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
            });
            return;
        }

        if (dni.length < 8 || dni.length > 8){
            Swal.fire({
                icon: "warning",
                title: "Campos Incorrectos",
                text: "Ingrese un DNI válido",
            });
            return;
        }

        if (telefono.length < 9 || telefono.length > 9){
            Swal.fire({
                icon: "warning",
                title: "Campos Incorrectos",
                text: "Ingrese un teléfono válido",
            });
            return;
        }

        nombre = capitalizeWords(nombre);
        apellidos = capitalizeWords(apellidos);

        $.ajax({
            url: "./controllers/usuario/registrarUsuario.php",
            type: "POST",
            dataType: "json",
            data: { nombre, apellidos, telefono, dni, usuario, rol, area, password },
            success: function(response) {
                if (response.message === '¡Usuario encontrado!') {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "El usuario que intenta registrar ya se encuentra registrado"
                    });
                } else if (response.status === 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Registro Exitoso",
                        text: "Se registró correctamente el usuario"
                    }).then(() => {
                        $('#modalRegistrarUsuario').modal('hide');

                        let codArea = $('.selectArea').val();

                        $.ajax({
                            url: './controllers/usuario/obtenerUsuariosPorArea.php',
                            method: 'POST',
                            dataType: 'json',
                            data: {codArea},
                            success: function(response) {
                                let options = `<option value="0">Seleccionar</option>` + // Agregar la opción "Seleccionar"
                                    response.data.map(usuario =>
                                        `<option value="${usuario.codUsuarioArea}">${usuario.usuario}</option>`
                                    ).join('');

                                $('.selectUsuarioDestino').html(options);
                            }
                        });
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Ocurrió un error al momento de registrar el usuario: " + response.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });

    // nuevo
    $(document).off("click", "#btnRegistrarIndicacion").on("click", "#btnRegistrarIndicacion", function(e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarIndicacion");
        $("#registrarIndicacionForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function() {
            $("#descripcionIndicacionNuevo").focus();
        });
    });

    // Registrar
    $(document).off('submit', '#registrarIndicacionForm').on('submit', '#registrarIndicacionForm', function(e) {
        e.preventDefault();

        let descripcion = $.trim($('#descripcionIndicacionNuevo').val());

        if (descripcion.length === 0) {
            Swal.fire({
                icon: "warning",
                title: "Campos Incompletos",
                text: "Ingrese los campos requeridos",
                allowEnterKey: false,
                allowEscapeKey: false,
                allowOutsideClick: false,
                stopKeydownPropagation: false
            });
            return;
        }

        descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/indicacion/registrarIndicacion.php",
            type: "POST",
            datatype: "json",
            data: { descripcion: descripcion },
            success: function(response) {
                response = JSON.parse(response);
                if (response.message === 'indicacion encontrada') {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "La indicación que intenta registrar ya existe",
                        allowEnterKey: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        stopKeydownPropagation: false
                    });
                } else {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "¡Éxito!",
                            text: response.message,
                            allowEnterKey: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            stopKeydownPropagation: false
                        }).then(() => {
                            $('#modalRegistrarIndicacion').modal('hide');
                            $.ajax({
                                url: "./controllers/indicacion/listarIndicaciones.php",
                                type: "GET",
                                datatype: "json",
                                data: {pagina: 1, registrosPorPagina: 999},
                                success: function(indicaciones) {
                                    indicaciones = JSON.parse(indicaciones);
                                    if (indicaciones && Array.isArray(indicaciones)) {
                                        let options = `<option value="0">Seleccionar</option>` +
                                            indicaciones.map(indicacion =>
                                                `<option value="${indicacion.codIndicacion}">${indicacion.descripcion}</option>`
                                            ).join('');

                                        $('.selectMovimiento').html(options);
                                    } else {
                                        console.warn('No data received or data is not an array.');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error fetching the content:', textStatus, errorThrown);
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message,
                            allowEnterKey: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            stopKeydownPropagation: false
                        });
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });

    function capitalizeWords(str) {
        const exceptions = new Set(['y', 'de', 'a', 'en', 'o', 'con', 'para', 'por', 'que', 'si', 'el', 'la', 'los', 'las', 'un', 'una', 'del', 'al']);

        return str
            .toLowerCase()
            .split(' ')
            .map((word, index, array) => {
                if (index === 0 || !exceptions.has(word)) {
                    return word.charAt(0).toUpperCase() + word.slice(1);
                }
                return word;
            })
            .join(' ');
    }
})