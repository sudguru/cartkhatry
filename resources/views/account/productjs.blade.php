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
                    url: '/account/image/delete',
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
                    url: '/account/image/sort',
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
        // Delivery Enable Disable
        function disable_enable(val) {
            val = val == 0 ? true : false;
            $('#delivery_day_from').prop('disabled', val);
            $('#delivery_day_to').prop('disabled', val);
            $('#delivery_charge_local').prop('disabled', val);
            $('#delivery_charge_intercity').prop('disabled', val);
            $('#delivery_charge_intl').prop('disabled', val);
        }
        
        disable_enable($('#delivery_available').val());

        $('#delivery_available').on('change', function() {
            disable_enable($(this).val());
        })
        // Delivery Enable Disable End

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

        $('.selectsizeclass').on('change', function() {

            var selected = $(this).find('option:selected');
            var size = selected.data('size');
            $('#sizename').val(size);
            console.log(size);
        });


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




        $('#productPrices').on('click', '.deletePrice' , function(){
            if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) {
                var data = {
                    price_id: this.id,
                    _token: '<?php echo csrf_token() ?>'
                }
                $.ajax({
                    url: '{{route('account.price.destroy') }}',
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

        

        $('#form-add-price').on("submit", function (event) {

            event.preventDefault();
            var discounted = $('#discounted').val();
            if (discounted == '' || discounted == 0) {
                $('#discounted').val($('#regular').val());
            }
            var form = new FormData(this);
            $.ajax({
                url: '{{route('account.price.store') }}',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response);
                    $('#currentPriceId').val(response);
                    var newprice = '<tr id="row-' + response + '">' +
                        '<td>' + $('#sizename').val() + '</td>' +
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