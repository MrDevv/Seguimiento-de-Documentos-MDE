$(document).ready(function() {
    $.ajax({
        url: "./controllers/movimiento/listarMovimientos.php",
        type: "GET",
        datatype: "json",
        success: function(movimientos) {
            movimientos = JSON.parse(movimientos);
            if (movimientos && Array.isArray(movimientos)) {
                let options = `<option value="0">Seleccionar</option>` +
                    movimientos.map(movimiento =>
                        `<option value="${movimiento.codMovimiento}">${movimiento.descripcion}</option>`
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