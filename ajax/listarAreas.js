$(document).ready(function() {
    $.ajax({
        url: './controllers/areas/listarAreas.php',
        method: 'GET',
        dataType: 'json', // Asegúrate de que el servidor responda con JSON
        success: function(data) {
            if (data && Array.isArray(data)) {
                // Construir las opciones para el select
                let options = `<option value="0">Seleccionar</option>` + // Agregar la opción "Seleccionar"
                    data.map(area =>
                        `<option value="${area.codArea}">${area.descripcion}</option>`
                    ).join('');

                // Actualizar el contenido del select
                $('.selectArea').html(options);
            } else {
                console.warn('No data received or data is not an array.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });
});
