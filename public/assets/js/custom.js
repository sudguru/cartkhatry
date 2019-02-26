$(document).ready(function () {
    
    $('#message_ticker').list_ticker({
        speed: 5000,
        effect: 'fade'
    });

    $('.btn-add-to-cart').on('click', function() {
        var qty = 1;
        var priceid = $('#txtpriceid').val();
        if($(this).attr('title') == 'Direct Order') {
            window.location = "/checkoutdirect/{{$product->slug}}/" + qty + "/" + priceid;
        } else {
            window.location = "/add-to-cart/{{$product->slug}}/" + priceid + "/" + qty;
        }
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