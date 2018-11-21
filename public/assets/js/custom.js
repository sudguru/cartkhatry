$(document).ready(function () {
    $('#message_ticker').list_ticker({
        speed: 5000,
        effect: 'fade'
    });

    $('.changeprice').on('click', function () {
        var id = $(this).attr('id');
        var fromqty = $(this).data('fromqty');
        var toqty = $(this).data('toqty');
        var regular = $(this).data('regular');
        var discounted = $(this).data('discounted');
        var name = $(this).html();
        var colors = $(this).data('colors');
        var colors_array = colors.substr(1).split('~');
        var colors_html = '';
        colors_array.forEach(function (color, i) {
            a = '';
            if (i == 0) a = 'active activeColor';
            colors_html += '<li class="' + a + ' productColor" data-color="' + color + '">' +
                '<a href="#" style="background-color: ' + color + '"></a>' +
                '</li>';
        });

        var prices = '';
        if (regular == discounted) {
            prices = '<span class="product-price">Rs. ' + regular + '</span>';
        } else {
            prices = '<span class="old-price">Rs. ' + regular + '</span>' +
                '<span class="product-price">Rs. ' + discounted + '</span>';
        }
        $selectedprice = '<div class="price-box">' +
            prices +
            '</div>';
        if (colors_array[0] != '') {
            $selectedprice +=
                '<div class="product-single-filter">' +
                '<label>Colors: </label>' +
                '<ul class="config-swatch-list">' +
                colors_html +
                '</ul>' +
                '</div>';
        }
        $('#dropdownMenuButtonPrice').html(name);
        $('#product-price-detail').html($selectedprice);

        var x = 1;
        var calc_qty = fromqty ? fromqty : x;

        $('#productQty').val(calc_qty);
        $('#cart_price').val(discounted);
        $('#cart_color').val($('.activeColor').data('color'));

        if (regular == discounted) {
            $('#sticky-old-price').html('');
            $('#sticky-product-price').html(regular);
        } else {
            $('#sticky-old-price').html(regular);
            $('#sticky-product-price').html(discounted);
        }
        
    });

    $('#productQty').on('change', function () {
        var q = $(this).val();
        $(".changeprice[data-fromqty=" + q + "]").trigger("click");
        // $(".changeprice[data-toqty="+q+"]").trigger("click");
    })

    $('body').on('click', '.productColor', function () {
        $('#cart_color').val($(this).data('color'));
        $(this).addClass('active').addClass('activeColor').siblings().removeClass('active').removeClass('activeColor');
    });
});
