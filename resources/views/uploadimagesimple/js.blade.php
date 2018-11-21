<script src="{{ asset('assets/js/sortable.min.js') }}"></script>
<script>
    var list = document.getElementById("productImages");
    Sortable.create(list, {
        animation: 150,
        filter: '.js-remove',
		onFilter: function (evt) {
            if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) {
                evt.item.parentNode.removeChild(evt.item);
                console.log(evt.item.getAttribute("data-id"));
                var data = {
                    pic_id: evt.item.getAttribute("data-id"),
                    product_id : {{$product->id}},
                    _token: '<?php echo csrf_token() ?>'
                };
                $.ajax({
                    type:'POST',
                    url:'/image/delete',
                    data: data,
                    success:function(data){
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
                    product_id: {{$product->id}},
                    _token: '<?php echo csrf_token() ?>'
                };

                $.ajax({
                    type:'POST',
                    url:'/image/sort',
                    data: data,
                    success:function(data){
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script src="{{ asset('assets/plugins/colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.min.js') }}"></script>
<script>
    $(document).ready(function () {

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

        $('#btnInsert').hide();

        $('#caption_form').on("submit", function (event) {
            //insert button click
            event.preventDefault();
            if ($('#pic_id').val() == 0) return;
            if ($('#caption').val() == "") {
                alert("Please type image caption. Later this will help you search for this images.")
                return;
            }
            var form = new FormData(this);
            $.ajax({
                url: '/image/savecaption',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    if(response == 'true') {
                        var newimage = '<li data-id="'+$('#pic_id').val()+'">' +
                                    '<img src="' + $('#pic_name').val() + '" style="width: 100%;cursor:move" />' +
                                    '<i class="js-remove" style="cursor:pointer">✖</i>' +
                                    '</li>';
                        console.log(newimage);
                        $('#productImages').append(newimage);
                        $('#caption_form').trigger("reset");
                        $('#upload_form').trigger("reset");
                        $('#imageHolder').html(
                            '<img src="/assets/images/product-placeholder.png" class="img-responsive" />'
                        );
                        $('#btnInsert').hide();
                        $('#myModal').modal('hide');
                    } else {
                        alert('Image already exists for this Product');
                    }
                },
                error: function (a, b, err) {
                    document.write(a.responseText);
                }
            });

        });

        $('#form-add-price').on("submit", function (event) {

            event.preventDefault();
            var discounted = $('#discounted').val();
            if( discounted == '' || discounted == 0) {
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
                    var newprice = '<tr id="row-'+response+'">' +
                            '<td>'+$('#pricename').val()+'</td>' +
                            '<td class="d-flex justify-content-start">' +
                                '<div class="d-flex flex-wrap justify-content-start" id="color-'+response+'">' +
                                '</div>' +
                                '<div class="color" style="background-color: #ddd; text-align: center">' +
                                    '<a href="javascript:void(0)" class="addpriceid" data-toggle="modal" data-target="#colorPickerModal">' +
                                        '<i class="fas fa-plus"></i></a>' +
                                '</div>' +
                            '</td>' +
                            '<td>'+$('#fromqty').val()+' - '+$('#toqty').val()+'</td>' +
                            '<td style="text-align: right">'+$('#regular').val()+'</td>' +
                            '<td style="text-align: right">'+$('#discounted').val()+'</td>' +
                            '<td>'+$('#discount_valid_until').val()+'</td>' +
                            '<td><i class="fas fa-trash deletePrice" id="'+response+'"></i></td>' +
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

        $('#upload_form').on("submit", function (event) {
            $('#imageHolder').html('<img src="/assets/images/blueloading.gif"/>');

            event.preventDefault();
            var image = $('#image')[0].files[0];
            var form = new FormData(this);

            $.ajax({
                url: '/image/upload',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {

                    var obj = JSON.parse(response);

                    $('#imageHolder').html('<img src="' + obj.path + '" class="img-responsive"/>');
                    $('#pic_id').val(obj.pic_id); //for caption save
                    $('#pic_name').val(obj.path);
                    $('#btnInsert').show();
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    $('#imageHolder').html(
                        '<img src="/assets/images/product-placeholder.png" class="img-responsive" />'
                    );

                    console.log(errors);
  
                }
            });
        });

        $('#search_form').on( "submit", function(event) { 
            event.preventDefault();
            var form = new FormData(this);

            $.ajax({
                url: '/image/search',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success:function(response) {
                    console.log(response);

                    var fullpath = '/storage/images/{{ auth()->user()->id}}/thumb_240/';

                    var output = '';
                    var picpath = '';
                    response.forEach(function(row) {
                        picpath = fullpath + row.pic_path;
                        datasizes = row.lg + '-' + row.md + '-' + row.sm + '_' + row.xs;
                        output += '<div class="col-sm-6 col-md-3">' +
                                    '<div class="thumbnail">' +
                                        '<div class="fixedbox">' +
                                            '<img src="'+picpath+'" class="sitepics" style="width: 100%" id="pic-'+row.id+'" data-sizes="'+datasizes+'" data-caption="'+row.caption+'" />' +
                                        '</div>' +
                                        '<div class="caption">' +
                                            row.caption
                                        +'</div>' +
                                    '</div>' +
                                '</div>';
                    });
                    $('#image_browse').html(output);
                    
                },
                error: function(a,b,err) {
                    document.write(a.responseText);
                }
            });
        });

         $('#image_browse').on('click', 'img.sitepics' , function(){

            $('#lg').attr('disabled', false);
            $('#md').attr('disabled', false);
            $('#sm').attr('disabled', false);
            $('#xs').attr('disabled', false);

            var pic = (this.id).split('-');
            var pic_id = pic[1];
            var src = this.src;
            //src = src.replace("_240/", "_400/");
            console.log(src);
            $('#myTabs a[href="#new"]').tab('show');
            var sizes = $(this).data("sizes").split("-");
            var caption = $(this).data("caption");
            console.log(caption);
            if(sizes[0] == "0") $('#lg').attr('disabled', true);
            if(sizes[1] == "0") $('#md').attr('disabled', true);
            if(sizes[2] == "0") $('#sm').attr('disabled', true);
            if(sizes[3] == "0") $('#xs').attr('disabled', true);

            $('#imageHolder').html('<img src="' + src + '" style="width:100%" />');
            $('#pic_id').val(pic_id); //for caption save
            $('#pic_name').val(src);
            $('#caption').val(caption);
            $('#btnInsert').show();
        });
    });

</script>
