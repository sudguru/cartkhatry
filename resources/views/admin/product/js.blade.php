<script src="{{ asset('assets/js/sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote.min.js') }}"></script>
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
                    url: '/adm/image/delete',
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
            $('#size_id_hidden-'+$('#price_id').val()).val($('#size_id').val());
        });


        // $('.copycolor').on('click', function () {
        //     var colorbox = $('#txtcopycolor');
        //     var color = $(this).data("color");
        //     colorbox.css('display', 'inline-block');
        //     colorbox.val(color);
        //     colorbox.select();
        //     document.execCommand("copy");
        //     colorbox.css('display', 'none');
        //     alert("Color Copied to Clipboard!")
        // });
        // $('#cp7').colorpicker({
        //     color: '#ffaa00'
        // });




        $('#productPrices').on('click', '.deletePrice' , function(){
            if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) {
                var data = {
                    price_id: this.id,
                    _token: '<?php echo csrf_token() ?>'
                }
                $.ajax({
                    url: '{{route('price.destroy') }}',
                    data: data,
                    type: 'POST',
                    success: function (response) {
                        
                        var rowtoremove = "#row-" + response;
                        $(rowtoremove).remove();
                    }
                });
            }
        });

        $('#productPrices').on('click', '.editPrice' , function(){
            $price_id_to_edit = $(this).attr('id').split("-")[1];
            $('#price_id').val($price_id_to_edit);
            $('#size_id').val($('#size_id_hidden-'+$price_id_to_edit).val());
            $('#regular').val($('#regular_value-'+$price_id_to_edit).html());
            $('#discounted').val($('#discounted_value-'+$price_id_to_edit).html());
            $('#discount_valid_until').val($('#discount_valid_until_value-'+$price_id_to_edit).html());
            $('#sizename').val($('#sizename_value-'+$price_id_to_edit).html());
            $('#mytask').val('edit');
            $('#price_save_btn').html('Update Price');

        });

        // $('#productPrices').on('click', '.addpriceid' , function(){
        //     $('#currentPriceId').val($(this).parent().prev().attr('id').split('-')[1]);
        // });

        $('[data-toggle="datepicker"]').datepicker({
            date: new Date(),
            startDate: new Date(),
            autoHide: true,
            format: 'yyyy-mm-dd',
            zIndex: 2000
        });

        var x = document.getElementById("snackbar");
        if (x) {
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        $('.stock').on('click', function(event) {
            event.preventDefault();
            var status = $(this).data('stock');
            var id = $(this).attr('id').split("-")[1];
            if(status == 1) {
                status = 0;
            } else {
                status = 1;
            }
            var that = this;
            var data = {
                    price_id: id,
                    status: status,
                    _token: '<?php echo csrf_token() ?>'
                }
            $.ajax({
                url: '{{route('price.stockupdate') }}',
                data: data,
                type: 'POST',
                success: function (response) {
                    $(that).data('stock', response);
                    if(response == 1) {
                        $('#stock-'+id).html('<span style="color:green">Yes</span>');
                    } else {
                        $('#stock-'+id).html('<span style="color:red">No</span>');
                    }
                }
            });
        });

        $('#form-add-price').on("submit", function (event) {

            event.preventDefault();
            var discounted = $('#discounted').val();
            if (discounted == '' || discounted == 0) {
                $('#discounted').val($('#regular').val());
            }
            var form = new FormData(this);
            $price_id = $('#price_id').val();
            if($('#mytask').val() == "add") {
                $.ajax({
                    url: '{{route('price.store') }}',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (response) {

                        // $('#currentPriceId').val(response);
                        var newprice = '<tr id="row-' + response + '">' +
                            '<td id="sizename_value-'+response+ '">' + $('#sizename').val() + '</td>' +
                            '<td style="text-align: right"><span id="regular_value-'+response+'">' + $('#regular').val() + '</span></td>' +
                            '<td style="text-align: right"><span id="discounted_value-'+response+'">' + $('#discounted').val() + '</span></td>' +
                            '<td id="discount_valid_until_value-'+response+ '">' + $('#discount_valid_until').val() + '</td>' +
                            '<td><input type="text" id="size_id_hidden-'+response+'" value="' + $('#size_id').val() +'">' +
                            '<i class="fas fa-edit editPrice pointer" id="update-' + response +'"></i>&nbsp;&nbsp;&nbsp;' +
                            '<i class="fas fa-trash deletePrice pointer" id="' + response +
                            '"></i></td>' +
                            '</tr>';

                        $('#productPrices').append(newprice);
                        $('#form-add-price').trigger("reset");


                    },
                    error: function (a, b, err) {
                        document.write(a.responseText);
                    }
                });
            } else {
                $.ajax({
                    url: '{{route('price.update') }}',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (response) {
                        $newsizeid = $('#size_id').val();
                        $('#sizename_value-'+response).html($('#sizename').val());
                        $('#regular_value-'+response).html($('#regular').val());
                        $('#discounted_value-'+response).html($('#discounted').val());
                        $('#discount_valid_until_value-'+response).html($('#discount_valid_until').val());
                        $('#form-add-price').trigger("reset");
                        $('#size_id_hidden-'+response).val($newsizeid);
                        $('#sizename').val('Regular');
                        $('#mytask').val('add');
                        $('#price_save_btn').html('Add Price');

                    },
                    error: function (a, b, err) {
                        document.write(a.responseText);
                    }
                });
            }

        });
    })
</script>