$(document).ready(function() {
    $('.menu a').click(function(event) {
        event.preventDefault();
        const page = $(this).attr('href');

        $.ajax({
            url: page,
            method: 'GET',
            success: function(data) {
                $('.main').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    });
});