$(document).ready(function(){

    $(document).off("click", "#btnDetalleEnvio").on("click", "#btnDetalleEnvio", function(e) {
        e.preventDefault();
        let fila = $(this).closest("tr");
        let codEnvio = fila.find('td:eq(9)').text();

        $.ajax({
            url: "./controllers/documento/obtenerDetalle.php",
            type: "POST",
            dataType: "json",
            data: { codEnvio },
            success: function(response) {
                console.log(response)
                let { status, data } = response;
                if (status == 'success') {
                    let modalVerDetalleEnvio = $("#modalDetalleEnvio");

                    let numDocumento = data[0]['NumDocumento'];
                    let estadoDocumento = data[0]['estado documento'];
                    let tipoDocumento = data[0]['tipo documento'];

                    console.log(estadoDocumento)

                    $("#numDocumentoDetalle").text(numDocumento);
                    $("#tipoDocumentoDetalle").text(tipoDocumento);

                    let estadoSpan = $("#estadoDocumentoDetalle");
                    estadoSpan.text(estadoDocumento === 'a' ? 'En Seguimiento' : 'Finalizado');
                    estadoSpan.removeClass('follow finished').addClass(estadoDocumento === 'a' ? 'estado follow' : 'estado finished');

                    if (data.length > 0 && Array.isArray(data)) {
                        let areaOrigen = data[0]['area origen'];
                        let fechaEnvio = data[0]['fechaEnvio'];
                        let horaEnvio = data[0]['hora envio'];
                        let usuarioOrigen = data[0]['usuario origen'];

                        let areaDestino = data[0]['area destino'];
                        let fechaRecepcion = data[0]['fechaRecepcion'];
                        let horaRecepcion = data[0]['hora recepcion'];
                        let usuarioDestino = data[0]['usuario destino'];
                        let estadoRecepcion = data[0]['estado recepcion'];

                        let observaciones = data[0]['observaciones'];


                        $("#areaOrigenDetalle").val(areaOrigen);
                        $("#fechaEnvioDetalle").val(fechaEnvio);
                        $("#horaEnvioDetalle").val(horaEnvio);
                        $("#usuarioOrigenDetalle").val(usuarioOrigen);

                        $("#areaDestinoDetalle").val(areaDestino);
                        $("#fechaRecepcionDetalle").val(fechaRecepcion);
                        $("#horaRecepcionDetalle").val(horaRecepcion);
                        $("#usuarioDestinoDetalle").val(usuarioDestino);

                        let estadosRecepcionContainer = $("#estadosRecepcion");

                        if (estadoRecepcion === 'e'){
                            estadosRecepcionContainer.html(`
                               <span class="estado recepcionado"> Recepcionado </span>
                               <span class="estado enviado"> Enviado </span>
                            `)
                        }else if (estadoRecepcion === 'a'){
                            estadosRecepcionContainer.html(`<span class="estado recepcionado"> Recepcionado </span>`)

                        }else if (estadoRecepcion === 'i') {
                            estadosRecepcionContainer.html(`<span class="estado pendienteRecepcion"> Pendiente de Recepción </span>`)
                        }

                        $("#observacionDetalle").text(observaciones);





                        modalVerDetalleEnvio.modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                        modalVerDetalleEnvio.modal('show');
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });

})