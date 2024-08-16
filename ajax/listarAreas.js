$(document).ready(function() {
    $.ajax({
        url: './controllers/areas/listarAreas.php',
        method: 'GET',
        dataType: 'json',
        data: {pagina: 1, registrosPorPagina: 900},
        success: function(data) {
            if (data && Array.isArray(data)) {
                let options = `<option value="0">Seleccionar</option>` +
                    data.map(area =>
                        `<option value="${area.codArea}">${area.descripcion}</option>`
                    ).join('');

                $('.selectArea').html(options);
            } else {
                let options = `<option value="0">Seleccionar</option>`
                $('.selectArea').html(options);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });
});
