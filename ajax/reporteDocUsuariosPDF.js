$(document).ready(function(){
    $(document).off('click', '#btnReporteDocUsuarioPdf').on('click', '#btnReporteDocUsuarioPdf', function(e) {
        e.preventDefault();

        let usuario = $(".selectUsuario").val()
        let numDocumento = $("#numDocumentoReportePorUsuario").val()
        let usuarioText = $(".selectUsuario option:selected").text();

        if (usuario == '0'){
            usuario = null;
        }

        if (numDocumento.length == 0 || !numDocumento){
            numDocumento = null;
        }

        $.ajax({
            url: './controllers/reportes/totalDocumentosPorUsuario.php',
            method: 'GET',
            dataType: 'json',
            data: {numDocumento, usuario},
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
                    url: "./controllers/reportes/documentosPorUsuarioPDF.php",
                    type: "POST",
                    data: {numDocumento, usuario, usuarioText},
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
