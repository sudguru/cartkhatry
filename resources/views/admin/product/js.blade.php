<script src="{{ asset('assets/js/sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote.min.js') }}"></script>
<script src="{{ asset('assets/plugins/colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.min.js') }}"></script>
<script>
    var list = document.getElementById("productImages");
    Sortable.create(list, {
        animation: 150,
        filter: '.js-remove',
        onFilter: function (evt) {
            if (confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.')) {
                evt.item.parentNode.removeChild(evt.item);
                console.log(evt.item.getAttribute("data-id"));
                var data = {
                    pic_id: evt.item.getAttribute("data-id"),
                    product_id: {{ $product->id }},
                    _token: '<?php echo csrf_token() ?>'
                };
                $.ajax({
                    type: 'POST',
                    url: '/image/delete',
                    data: data,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        },
        store: {
            get: function (sortable) {
                var order = sortable.toArray();
            },

            set: function (sortable) {
                var order = sortable.toArray();
                console.log(order);
                var data = {
                    order: order,
                    product_id: {{$product->id }},
                    _token: '<?php echo csrf_token() ?>'
                };

                $.ajax({
                    type: 'POST',
                    url: '/adm/image/sort',
                    data: data,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        }
    });

    function setCurrentPriceId(priceid) {
        $('#currentPriceId').val(priceid)
    }
</script>
<script>
    $(document).ready(function () {
        $('.copycolor').on('click', function () {
            var colorbox = $('#txtcopycolor');
            var color = $(this).data("color");
            colorbox.css('display', 'inline-block');
            colorbox.val(color);
            colorbox.select();
            document.execCommand("copy");
            colorbox.css('display', 'none');
            alert("Color Copied to Clipboard!")
        });
        $('#cp7').colorpicker({
            color: '#ffaa00'
        });


        $('#btnColor').on('click', function() {
            var data = {
                price_id: $('#currentPriceId').val(),
                _token: '<?php echo csrf_token() ?>',
                newcolor: $('#selectedColor').val()
            }
            $.ajax({
                url: '/account/product/price/color',
                data: data,
                type: 'POST',
                success: function (response) {
                    var newcolor = '<div class="color" style="background-color: '+ $('#selectedColor').val()+'">' +
                        '<i class="colorRemove" style="cursor:pointer" data-color="'+ $('#selectedColor').val()+'">✖</i>' +
                        '</div>';
                    var colorDiv = "#color-" + $('#currentPriceId').val(); 
                    $(colorDiv).append(newcolor);
                    $('#colorPickerModal').modal('hide');
                }
            });
            
        });

        $('body').on('click', '.colorRemove' , function(){
            if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) {
                var colortoremove = $(this).data('color');
                // alert(colortoremove);
                $('#currentPriceId').val($(this).parent().parent().attr('id').split('-')[1]);
                var data = {
                    price_id: $('#currentPriceId').val(),
                    _token: '<?php echo csrf_token() ?>',
                    colortoremove: "~" + colortoremove
                }
                var that = this;
                $.ajax({
                    url: '/account/product/price/color/remove',
                    data: data,
                    type: 'POST',
                    success: function (response) {

                        $(that).parent().remove();
                    }
                });
            }
        });

        $('#productPrices').on('click', '.deletePrice' , function(){
            if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) {
                var data = {
                    price_id: this.id,
                    _token: '<?php echo csrf_token() ?>'
                }
                $.ajax({
                    url: '/account/product/price/delete',
                    data: data,
                    type: 'POST',
                    success: function (response) {
                        
                        var rowtoremove = "#row-" + response;
                        $(rowtoremove).remove();
                    }
                });
            }
        });

        $('#productPrices').on('click', '.addpriceid' , function(){
            $('#currentPriceId').val($(this).parent().prev().attr('id').split('-')[1]);
        });

        $('[data-toggle="datepicker"]').datepicker({
            date: new Date(),
            startDate: new Date(),
            autoHide: true,
            format: 'yyyy/mm/dd',
            zIndex: 2000
        });

        var x = document.getElementById("snackbar");
        if (x) {
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        $('#description').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']]
            ]
        });

        $('#specification').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                ['height', ['height']],
                ['fullscreen']
            ]
        });

        $('#form-add-price').on("submit", function (event) {

            event.preventDefault();
            var discounted = $('#discounted').val();
            if (discounted == '' || discounted == 0) {
                $('#discounted').val($('#regular').val());
            }
            var form = new FormData(this);
            $.ajax({
                url: '/account/product/price',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {

                    $('#currentPriceId').val(response);
                    var newprice = '<tr id="row-' + response + '">' +
                        '<td>' + $('#pricename').val() + '</td>' +
                        '<td class="d-flex justify-content-start">' +
                        '<div class="d-flex flex-wrap justify-content-start" id="color-' +
                        response + '">' +
                        '</div>' +
                        '<div class="color" style="background-color: #ddd; text-align: center">' +
                        '<a href="javascript:void(0)" class="addpriceid" data-toggle="modal" data-target="#colorPickerModal">' +
                        '<i class="fas fa-plus"></i></a>' +
                        '</div>' +
                        '</td>' +
                        '<td>' + $('#fromqty').val() + ' - ' + $('#toqty').val() + '</td>' +
                        '<td style="text-align: right">' + $('#regular').val() + '</td>' +
                        '<td style="text-align: right">' + $('#discounted').val() + '</td>' +
                        '<td>' + $('#discount_valid_until').val() + '</td>' +
                        '<td><i class="fas fa-trash deletePrice" id="' + response +
                        '"></i></td>' +
                        '</tr>';

                    $('#productPrices').append(newprice);
                    $('#form-add-price').trigger("reset");

                    $('#priceModalAdd').modal('hide');

                },
                error: function (a, b, err) {
                    document.write(a.responseText);
                }
            });

        });
    })
</script>