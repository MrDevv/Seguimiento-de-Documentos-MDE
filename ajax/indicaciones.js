$(document).ready(function() {
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
})