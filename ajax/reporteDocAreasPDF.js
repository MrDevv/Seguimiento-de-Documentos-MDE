$(document).ready(function() {
    $(document).off('click', '#btnReporteDocAreaPdf').on('click', '#btnReporteDocAreaPdf', function(e) {
        e.preventDefault();

        let area = $(".selectArea").val();
        let areaText = $(".selectArea option:selected").text();
        let numDocumento = $("#numDocumentoReportePorArea").val();

        if (area == '0') {
            area = null;
        }

        if (numDocumento.length == 0 || !numDocumento) {
            numDocumento = null;
        }

        $.ajax({
            url: './controllers/reportes/totalDocumentosPorArea.php',
            method: 'GET',
            dataType: 'json',
            data: { numDocumento, area },
            success: function(response) {
                let { data } = response;
                let totalDocumentos = data[0]['total'];

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

                // Solo abrir la nueva ventana si hay resultados
                var newTab = window.open();

                $.ajax({
                    url: "./controllers/reportes/documentosPorAreaPDF.php",
                    type: "POST",
                    data: { numDocumento, area, areaText },
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
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });
});
