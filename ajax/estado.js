$(document).ready(function(){

    $.ajax({
        url: './controllers/estado/listarEstados.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data)
            if (data && Array.isArray(data)) {
                let options = data.map(estado =>
                    `<option value="${estado.codEstado}">${estado.descripcion == 'a' ? 'Activos' : 'Inactivos'}</option>`
                ).join('');
                $('.selectEstado').html(options);
            } else {
                console.warn('No data received or data is not an array.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });

})