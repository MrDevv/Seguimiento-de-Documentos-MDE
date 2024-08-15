$(document).ready(function(){
    $(document).off('click', '#btnReporteDocRecepcionadosPdf').on('click', '#btnReporteDocRecepcionadosPdf', function(e) {
        e.preventDefault();

        let numDocumento = $("#numDocumentoReporteRecepcionados").val()
        let fechaInicio = $("#fechaInicioReporteRecepcionados").val()
        let fechaFin = $("#fechaFinReporteRecepcionados").val()
        let nombresUsuario = $("#nombresUsuarioLog").text()
        let userNameUsuario = $(".username").text()
        let areaUsuario = $("#areaUsuarioLog").text()
        let rolUsuario = $("#rolUsuarioLog").text()

        nombresUsuario = nombresUsuario.replace(userNameUsuario, '')
        areaUsuario = areaUsuario.replace(rolUsuario, '')

        $.ajax({
            url: './controllers/reportes/totalDocumentosRecepcionados.php',
            method: 'GET',
            dataType: 'json',
            data: {numDocumento, fechaInicio, fechaFin},
            success: function(response) {
                let { data } = response;
                let totalDocumentos = data[0]['total']

                if (totalDocumentos == 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Advertencia!",
                        text: "No se encontraron resultados para el reporte",
                        allowEnterKey: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        stopKeydownPropagation: false
                    });
                    return;
                }

                // Abrir una nueva ventana en blanco
                var newTab = window.open();

                $.ajax({
                    url: "./controllers/reportes/documentosRecepcionadosPDF.php",
                    type: "POST",
                    data: {numDocumento, fechaInicio, fechaFin, nombresUsuario, areaUsuario},
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(blob) {
                        var url = window.URL.createObjectURL(blob);

                        // Asignar el URL del blob a la nueva pestaña
                        newTab.location.href = url;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching the content:', textStatus, errorThrown);
                        newTab.close();
                    }
                });

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });
});
