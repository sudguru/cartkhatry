$(document).ready(function () {
    
    $('#message_ticker').list_ticker({
        speed: 5000,
        effect: 'fade'
    });

    $('a').on('click', function(e) {
        var link = $(this).attr('href');
        link = link + '?cur='+ extra;
        e.preventDefault();
        location.href = link;
    });
});