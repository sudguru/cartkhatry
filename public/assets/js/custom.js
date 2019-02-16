$(document).ready(function () {
    
    $('#message_ticker').list_ticker({
        speed: 5000,
        effect: 'fade'
    });

    // $('a:not(#posted)').on('click', function(e) {
    //     e.preventDefault();
    //     var link = $(this).attr('href');
    //     if(link.indexOf("?") == -1) {
    //         link = link + '?cur='+ cur;
    //     }
    //     // alert(link);
    //     location.href = link;
    // });
});