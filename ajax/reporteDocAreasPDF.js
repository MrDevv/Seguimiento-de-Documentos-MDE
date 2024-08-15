$(document).ready(function(){
    $(document).off('click', '#btnReporteDocAreaPdf').on('click', '#btnReporteDocAreaPdf', function(e) {
        e.preventDefault();

        let area = $(".selectArea").val()
        let areaText = $(".selectArea option:selected").text();
        let numDocumento = $("#numDocumentoReportePorArea").val()

        if (area == '0'){
            area = null;
        }

        if (numDocumento.length == 0 || !numDocumento){
            numDocumento = null;
        }

        // Abrir una nueva ventana en blanco
        var newTab = window.open();

        $.ajax({
            url: "./controllers/reportes/documentosPorAreaPDF.php",
            type: "POST",
            data: {numDocumento, area, areaText},
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
    });
});
