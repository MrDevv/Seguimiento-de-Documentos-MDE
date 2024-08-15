$(document).ready(function() {
    let registrosPorPagina = 10;
    let pagina = 1;
    let numDocumento = $("#numDocumentoReporteEnviados").val()
    let fechaInicio = $("#fechaInicioReporteEnviados").val()
    let fechaFin = $("#fechaFinReporteEnviados").val()

    generarOpcionesPaginacion()
    obtenerDocumentosEnviados(numDocumento, fechaInicio, fechaFin, pagina, registrosPorPagina)

    function obtenerDocumentosEnviados(numDocumento, fechaInicio, fechaFin, pagina, registrosPorPagina) {
        console.log({numDocumento, fechaInicio, fechaFin, pagina, registrosPorPagina})
        $.ajax({
            url: './controllers/reportes/documentosEnviados.php',
            method: 'POST',
            data: {numDocumento, fechaInicio, fechaFin, pagina, registrosPorPagina},
            dataType: 'json',
            success: function(response) {
                console.log(response)
                let { data } = response;
                if (Array.isArray(data) && data.length > 0) {
                    let rows = data.map(documento => `
                        <tr>
                            <td>${documento.codEnvio}</td>
                            <td>${documento.NumDocumento}</td>
                            <td>${documento.folios}</td>
                            <td>${documento['tipo documento']}</td>
                            <td>${documento['area destino']}</td>
                            <td>${documento['usuario destino']}</td>
                            <td>${documento.fechaEnvio}</td>
                            <td>${documento['hora envio']}</td>
                            <td class="observacionEnvio">${documento.observaciones}</td>
                            <td class="invisible">${documento.codEnvio}</td>
                            <td>
                                <span class="estado ${ documento["estado recepcion"] == 'i' ? "pendienteRecepcion" : "recepcionado" }">
                                    ${documento['estado recepcion'] === 'i' ? 'Pendiente de Recepcion' : 'Recepcionado'}
                                </span>
                                ${documento['estado documento'] === 'i' ? '<span class="finished estado mt-1">Seguimiento finalizado</span>' : ''}
                            </td>
                        </tr>
                    `).join('');
                    $('#bodyEnviadosReporte').html(rows);
                } else {
                    $('#bodyEnviadosReporte').html('<tr><td colspan="11">No hay documentos recepcionados.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener documentos pendientes de recepción:', error);
            }
        });
    }

    // generar botones paginacion
    function generarOpcionesPaginacion() {
        console.log({numDocumento, fechaInicio, fechaFin})
        $.ajax({
            url: './controllers/reportes/totalDocumentosEnviados.php',
            method: 'GET',
            dataType: 'json',
            data: {numDocumento, fechaInicio, fechaFin},
            success: function(response) {
                let { data } = response;
                let totalDocumentos = data[0]['total']
                let totalPaginas = Math.ceil(totalDocumentos/registrosPorPagina);

                $('#totalDocumentosEnviadosReporte').text(totalDocumentos)

                let paginas = '';
                for (let i = 0; i < totalPaginas; i++){
                    paginas+= `<li class="optionPage${i+1==pagina ? ' selectedPage' : ''}" id=${i+1}> ${i+1} </li>`
                }

                $('#opcionesPaginacionDocumentosEnviadosReporte').html(paginas)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    // cambiar de pagina
    $(document).off("click", ".optionPage").on("click", ".optionPage", function (e) {
        if (pagina != parseInt($(this).text().trim())){
            $(".optionPage").removeClass("selectedPage");
            $(this).addClass("selectedPage");
        }
        pagina = parseInt($(this).text().trim());
        obtenerDocumentosEnviados(numDocumento, fechaInicio, fechaFin, pagina, registrosPorPagina)
    })

    // abrir modal para ver el seguimiento de un documento
    $(document).off("click", "#btnSeguimientoDocumentoRecepcionadoReporte").on("click", "#btnSeguimientoDocumentoRecepcionadoReporte", function(e) {
        e.preventDefault();
        let fila = $(this).closest("tr");
        let numDocumento = fila.find('td:eq(1)').text();

        $.ajax({
            url: "./controllers/documento/obtenerSeguimiento.php",
            type: "POST",
            dataType: "json",
            data: { numDocumento },
            success: function(response) {
                let { status, data } = response;
                console.log(response);
                if (status == 'success') {
                    let modalVerSeguimiento = $("#modalSeguimientoDocumento");

                    let estadoDocumento = data[0]['Estado Documento'];
                    let tipoDocumento = data[0]['tipo documento'];

                    $("#numDocumentoSeguimiento").text(numDocumento);
                    $("#tipoDocumentoSeguimiento").text(tipoDocumento);

                    let estadoSpan = $("#estadoDocumentoSeguimiento");
                    estadoSpan.text(estadoDocumento === 'a' ? 'En Seguimiento' : 'Finalizado');
                    estadoSpan.removeClass('follow finished').addClass(estadoDocumento === 'a' ? 'estado follow' : 'estado finished');

                    if (data.length > 0 && Array.isArray(data)) {
                        let row = data.map((documento, index) => `
                        <tr>
                            <td> ${index + 1} </td>
                            <td> ${documento.folios} </td>
                            <td> ${documento["area origen"]} </td>
                            <td> ${documento["usuario origen"]} </td>
                            <td> ${documento.fechaEnvio} </td>
                            <td class="columArrow"> <svg fill="#056251" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg> </td>
                            <td> ${documento["area destino"]} </td>
                            <td> ${documento["usuario destino"]} </td>
                            <td> ${documento.fechaRecepcion != null ? documento.fechaRecepcion : ''} </td>
                            <td class="invisible"> ${documento.codEnvio} </td>
                            <td class="observacionEnvio"> ${documento.observaciones} </td>
                            <td>
                                <span class="estado ${documento["estado recepcion"] == 'i' ? "pendienteRecepcion" : "recepcionado"} ">
                                    ${documento["estado recepcion"] == 'i' ? "Pendiente de Recepcion" : "Recepcionado"}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="#" class="action" id="btnDetalleEnvio">
                                        <span class="tooltipParent">Ver Detalle <span class="triangulo"></span></span>
                                        <svg width="36" height="34" viewBox="0 0 36 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2424_29)">
                                                <rect x="4" width="28" height="26" rx="5" fill="white"/>
                                                <path d="M27.3334 3.25H8.66671C7.37987 3.25 6.33337 4.22175 6.33337 5.41667V20.5833C6.33337 21.7783 7.37987 22.75 8.66671 22.75H27.3334C28.6202 22.75 29.6667 21.7783 29.6667 20.5833V5.41667C29.6667 4.22175 28.6202 3.25 27.3334 3.25ZM8.66671 20.5833V5.41667H27.3334L27.3357 20.5833H8.66671Z" fill="black"/>
                                                <path d="M11 7.5835H25V9.75016H11V7.5835ZM11 11.9168H25V14.0835H11V11.9168ZM11 16.2502H18V18.4168H11V16.2502Z" fill="black"/>
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2424_29" x="0" y="0" width="36" height="34" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dy="4"/>
                                                    <feGaussianBlur stdDeviation="2"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2424_29"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2424_29" result="shape"/>
                                                </filter>
                                            </defs>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `).join('');
                        $('#bodySeguimiento').html(row);

                        modalVerSeguimiento.modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        modalVerSeguimiento.modal('show');
                    }
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });

    // filtrar
    $(document).off("click", "#filtrarPorDocumentosEnviadosReporte").on("click", "#filtrarPorDocumentosEnviadosReporte", function(e) {
        e.preventDefault()
        numDocumento = $("#numDocumentoReporteEnviados").val()
        fechaInicio = $("#fechaInicioReporteEnviados").val()
        fechaFin = $("#fechaFinReporteEnviados").val()
        pagina = 1
        generarOpcionesPaginacion()
        obtenerDocumentosEnviados(numDocumento, fechaInicio, fechaFin, pagina, registrosPorPagina)
    })
})