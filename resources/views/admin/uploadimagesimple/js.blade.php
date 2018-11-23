

<script>
    $(document).ready(function () {

       

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
