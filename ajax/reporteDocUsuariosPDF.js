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
    });
});
