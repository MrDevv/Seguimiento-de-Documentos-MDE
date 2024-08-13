$(document).ready(function() {
    let registrosPorPagina = 10;
    let pagina = 1;

    generarOpcionesPaginacion()

    function loadIndicaciones(pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/indicacion/listarIndicaciones.php',
            method: 'GET',
            dataType: 'json',
            data: {pagina, registrosPorPagina},
            success: function(data) {
                if (data && Array.isArray(data)) {
                    let row = data.map(indicacion =>
                        `
                            <tr>
                                <td>${indicacion.codIndicacion}</td>
                                <td>${indicacion.descripcion}</td>
                                <td class="actions">
                                    <a class="action" id="btnEditarIndicacion" href="#">
                                        <span class="tooltipParent">Editar <span class="triangulo"></span></span>
                                        <svg width="38" height="34" viewBox="0 0 38 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g filter="url(#filter0_d_2928_43)">
                                                <rect x="4" width="30" height="26" rx="5" fill="white"/>
                                                <path d="M12.75 7.58301H11.5C10.837 7.58301 10.2011 7.81128 9.73223 8.21761C9.26339 8.62394 9 9.17504 9 9.74967V19.4997C9 20.0743 9.26339 20.6254 9.73223 21.0317C10.2011 21.4381 10.837 21.6663 11.5 21.6663H22.75C23.413 21.6663 24.0489 21.4381 24.5178 21.0317C24.9866 20.6254 25.25 20.0743 25.25 19.4997V18.4163" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M24 5.41678L27.75 8.66678M29.4813 7.13387C29.9736 6.7072 30.2501 6.12851 30.2501 5.52512C30.2501 4.92172 29.9736 4.34303 29.4813 3.91637C28.9889 3.4897 28.3212 3.25 27.625 3.25C26.9288 3.25 26.2611 3.4897 25.7688 3.91637L15.25 13.0001V16.2501H19L29.4813 7.13387Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                <defs>
                                                <filter id="filter0_d_2928_43" x="0" y="0" width="38" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                <feOffset dy="4"/>
                                                <feGaussianBlur stdDeviation="2"/>
                                                <feComposite in2="hardAlpha" operator="out"/>
                                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2928_43"/>
                                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2928_43" result="shape"/>
                                                </filter>
                                                </defs>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        `
                    ).join('');
                    // Actualizar el contenido del tbody de la tabla
                    $('#bodyListaIndicaciones').html(row);
                } else {
                    console.warn('No data received or data is not an array.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadIndicaciones(pagina, registrosPorPagina);

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
                            pagina = 1;
                            generarOpcionesPaginacion();
                            loadIndicaciones(pagina, registrosPorPagina);
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

    let descripcionDB = '';
    // Editar
    $(document).off("click", "#btnEditarIndicacion").on("click", "#btnEditarIndicacion", function(e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarIndicacion");
        let fila = $(this).closest("tr");
        let codIndicacion = parseInt(fila.find('td:eq(0)').text());
        let descripcion = fila.find('td:eq(1)').text();
        descripcionDB = descripcion;
        $("#descripcionIndicacionEditar").val(descripcion.trim());
        $("#codIndicacion").val(codIndicacion);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#descripcionIndicacionEditar").focus();
        });
    });

    // Actualizar
    $(document).off('submit', '#editarIndicacionForm').on('submit', '#editarIndicacionForm', function(e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit

        let descripcion = $.trim($('#descripcionIndicacionEditar').val());
        let codIndicacion = $.trim($('#codIndicacion').val());

        if (descripcion.length === 0 || codIndicacion.length === 0) {
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

        if (descripcionDB === descripcion) {
            Swal.fire({
                icon: "warning",
                title: "¡Advertencia!",
                text: "Para actualizar la indicación tiene que tener una nueva descripción.",
                allowEnterKey: false,
                allowEscapeKey: false,
                allowOutsideClick: false,
                stopKeydownPropagation: false
            });
            return;
        }

        descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/indicacion/actualizarIndicacion.php",
            type: "POST",
            datatype: "json",
            data: { codIndicacion, descripcion },
            success: function(response) {
                response = JSON.parse(response);
                if (response.message === 'indicacion encontrada') {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "La indicación que intenta actualizar ya existe en la base de datos",
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
                            $('#modalEditarIndicacion').modal('hide');
                            loadIndicaciones(pagina, registrosPorPagina)
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

    function generarOpcionesPaginacion() {
        $.ajax({
            url: './controllers/indicacion/totalIndicacionesRegistradas.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let totalAreas = response[0]['total']
                let totalPaginas = Math.ceil(totalAreas/registrosPorPagina);

                $('#totalIndicacionesRegistradas').text(totalAreas)

                let paginas = '';
                for (let i = 0; i < totalPaginas; i++){
                    paginas+= `<li class="optionPage${i==0 ? ' selectedPage' : ''}" id=${i+1}> ${i+1} </li>`
                }

                $('#opcionesPaginacionIndicaciones').html(paginas)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    $(document).off("click", ".optionPage").on("click", ".optionPage", function (e) {
        $(".optionPage").removeClass("selectedPage");
        $(this).addClass("selectedPage");
        pagina = parseInt($(this).text().trim());
        loadIndicaciones(pagina, registrosPorPagina);
    })

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