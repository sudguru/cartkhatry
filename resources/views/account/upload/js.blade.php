<style>
        .sitepics
        {
            cursor: pointer;
        }
        #imageHolder
        {
            padding: 15px;
            background-color: #efefef;
            text-align: center;
        }

        #imageHolder img
        {
            display:block;
            margin: 0 auto;
        }

        .fixedbox
        {
           max-height: 150px;
           min-height: 150px;
           overflow: hidden;
           background-color: #efefef;
       }
   </style>

   <script src="/js/ckeditor/ckeditor.js"></script>
   <script type="text/javascript">
    editor = CKEDITOR.replace('content')
    editor.addCommand("addImg", {
        exec: function(edt) {
                //alert(edt.getData());
                var selection = editor.getSelection();
                var element = selection.getStartElement();
                if ( element )
                    element = element.getAscendant( 'img', true );

                if ( !element || element.getName() != 'img' ) {
                    this.insertMode = true;
                }
                else
                    this.insertMode = false;
                if ( !this.insertMode )
                {
                    var src = element.getAttribute( "src" );
                    var aSrc = src.split('/');
                    var selectedSize = aSrc[4];
                    src = src.replace('/original/', '/thumb_240/');
                    src = src.replace('/thumb_1200/', '/thumb_240/');
                    src = src.replace('/thumb_800/', '/thumb_240/');
                    src = src.replace('/thumb_400/', '/thumb_240/');
                    $('#imageHolder').html('<img src="'+src+'" class="img-responsive" />');

                    var style = element.getAttribute( "style" );
                    var a = style.split(";");
                    var align = a[0].split(":");
                    var alignment = align[1];
                    $('input[name=alignment][value='+alignment+']').prop("checked",true);
                    
                    var dataid = element.getAttribute( "data-id" );
                    var picid = dataid.split("-")[1];
                    //alert(picid);

                    if($('#featured_pic_id').val() == picid)
                        $('input[name=featured][value=1]').prop("checked",true);
                    else
                        $('input[name=featured][value=0]').prop("checked",true);

                    $('#caption').val(element.getAttribute( "data-caption" ));

                    $('#lg').attr('disabled', false);
                    $('#md').attr('disabled', false);
                    $('#sm').attr('disabled', false);
                    $('#xs').attr('disabled', false);
                    var datasizes = element.getAttribute( "data-sizes" );
                    var ds = datasizes.split("-");
                    if( ds[0] == 0 ) $('#lg').attr('disabled', true);
                    if( ds[1] == 0 ) $('#md').attr('disabled', true);
                    if( ds[2] == 0 ) $('#sm').attr('disabled', true);
                    if( ds[3] == 0 ) $('#xs').attr('disabled', true);

                    $('input[name=insert_size][value='+selectedSize+']').prop("checked",true);

                    var pid = element.getAttribute( "data-id" ).split("-");
                    $('#pic_id').val(pid[1]);
                    $('#pic_name').val(basename(src));
                    $('#btnInsert').show();
                    $('#myTabs a[href="#new"]').tab('show');
                }
                else
                {
                    $('#imageHolder').html('<img src="/img/image_placeholder.jpg" class="img-responsive" />');
                    $('input[name=alignment][value=left]').prop("checked",true);
                    $('input[name=featured][value=0]').prop("checked",true);
                    $('#caption').val('');
                    $('input[name=insert_size][value=thumb_240]').prop("checked",true);
                    $('#pic_id').val('0');
                    $('#pic_name').val('');
                    $('#btnInsert').hide();
                }
                
                $('#myModal').modal('toggle');
            }
        });
    editor.addCommand("addAttachment", {
        exec: function(edt) {
            //alert(edt.getData());
            var selection = editor.getSelection();

            var element = selection.getStartElement();
            selection.selectElement(element);
            if ( element )
                element = element.getAscendant( 'a', true );

            if ( !element || element.getName() != 'a' ) {
                this.insertMode = true;
            }
            else
                this.insertMode = false;
            //alert(this.insertMode);
            if ( !this.insertMode )
                {
  
                    fid = element.getAttribute( "data-id" ).split("-");
                    var href = element.getAttribute( "href" );
                    //$('#captionfile').val(element.getAttribute( "data-caption" ));
                    if(fid[1] == 0) //simple link
                    {
                        $('#captionfile').val('');
                        $('#linktitle').val(element.getAttribute( "data-caption" ));
                        $('#linklink').val(href);

                        $('#file_id').val(fid[1]);
                        $('#file_name').val('');
                        $('#btnInsertFile').show();
                        $('#myTabsFile a[href="#simplefile"]').tab('show');
                    }
                    else
                    {
                        
                        var re = /(?:\.([^.]+))?$/;
                        var ext = re.exec(href)[1];   // "txt"

                        var str = "ppt,pptx,psd,mp3,mp4,mov,css,html,doc,docx,pdf,xls,xlsx,jpg,jpeg,zip";
                        var n = str.indexOf(ext);
                        var fileicon = '/img/filetypes/na.png';
                        if(n >= 0) //found
                        {
                            fileicon = '/img/filetypes/' + ext + '.png';
                        }
                        $('#imageHolderFile').html('<img src="'+fileicon+'" class="img-responsive" />');
                        $('#captionfile').val(element.getAttribute( "data-caption" ));
                        $('#linktitle').val('');
                        $('#linklink').val('');

                        $('#file_id').val(fid[1]);
                        $('#file_name').val(basename(href));
                        $('#btnInsertFile').show();
                        $('#myTabsFile a[href="#newfile"]').tab('show');
                    }
                    
                }
                else
                {
                    $('#imageHolderFile').html('<img src="/img/filetypes/na.png" class="img-responsive" />');
                    $('#captionfile').val('');
                    $('#linktitle').val('');
                    $('#linklink').val('');
                    $('#file_id').val('0');
                    $('#file_name').val('');
                    $('#btnInsertFile').hide();
                }
            $('#myModalFile').modal('toggle');
        }
    });
    editor.ui.addButton('ImageBtn', {
        label: "Insert Images",
        command: 'addImg',
        toolbar: 'insert',
        icon: '/img/image.png'
    });
    editor.ui.addButton('AttachmentBtn', {
        label: "Insert Attachments",
        command: 'addAttachment',
        toolbar: 'insert',
        icon: '/img/attachment.png'
    });
</script> 
<script type="text/javascript">
    CKEDITOR.replace( 'excerpt', {
        customConfig : 'configmin.js',
        toolbar : 'simple'
    })
</script> 
<script src="/js/mustache.min.js"></script>
<script>
    function replaceAll(str, find, replace) {
        return str.replace(new RegExp(find, 'g'), replace);
    }
    function basename(path) {
        return path.split('/').reverse()[0];
    }
</script>


<script>
        //Image Upload & Insert
        $( document ).ready(function() {
            //hide initially
            $('#btnInsert').hide();

            $('#btnCancel').on('click', function(){
                $('#myModal').modal('hide');
            });

            $('#caption_form').on( "submit", function(event) { 
                //insert button click
                event.preventDefault();
                if($('#pic_id').val() == 0) return;
                if($('#caption').val() == "") 
                {
                    alert("Please type image caption. Later this will help you search for this images.")
                    return;
                }
                var form = new FormData(this);
                $.ajax({
                    url: '/savecaption',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function(response) {
                        console.log(response);
                        
                        var featured = $("input[name='featured']:checked").val();
                        if(featured == 1)
                             $('#featured_pic_id').val($('#pic_id').val()); //for page save
                         var element = CKEDITOR.dom.element.createFromHtml( response );
                         CKEDITOR.instances.content.insertElement( element );
                        //Close
                        $('#myModal').modal('hide');
                    },
                    error: function(a,b,err) {
                        document.write(a.responseText);
                    }
                });           
                
            });





            $('#upload_form').on( "submit", function(event) { 
                $('#imageHolder').html('<img src="/img/loading.gif"/>');
                $('#lg').attr('disabled', false);
                $('#md').attr('disabled', false);
                $('#sm').attr('disabled', false);
                $('#xs').attr('disabled', false);
                event.preventDefault();
                var image = $('#image')[0].files[0];
                var form = new FormData(this);

                $.ajax({
                    url: '/uploadimage',
                    data: form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success:function(response) {
                        //alert('hello');
                        var obj = JSON.parse(response);

                        if(obj.lg == "0") $('#lg').attr('disabled', true);
                        if(obj.md == "0") $('#md').attr('disabled', true);
                        if(obj.sm == "0") $('#sm').attr('disabled', true);
                        if(obj.xs == "0") $('#xs').attr('disabled', true);

                        $('#imageHolder').html('<img src="' + obj.path + '" class="img-responsive"/>');
                        $('#pic_id').val(obj.pic_id); //for caption save
                        $('#pic_name').val(basename(obj.path));
                        $('#btnInsert').show();
                    },
                    error: function(data)
                    {
                        var errors = data.responseJSON;
                        //var errors = data.responseText;
                        $('#imageHolder').html('<img src="/img/image_placeholder.jpg" class="img-responsive" />');
                        var tpl = $('#ajaxErrors').html();
                        console.log(tpl);
                        console.log(data.responseText);
                        console.log(errors);
                        var output = Mustache.render(tpl, errors);
                        $('#upload_error').html(output);
                    }
                });
            });
        });

    </script>

    <script>
    //Image Browse
    $(document).ready(function(){
        $('#image_browse').on('click', 'img.sitepics' , function(){
            $this = $('#')
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

            $('#imageHolder').html('<img src="' + src + '" class="img-responsive" />');
            $('#pic_id').val(pic_id); //for caption save
            $('#pic_name').val(basename(src));
            $('#caption').val(caption);
            $('#btnInsert').show();
        });

        $('.insertpic').on('click', function() {
            //not used
            var url = $(this).closest("div.thumbnail").find("img.sitepics").attr("src");
            alert(url);
        });



        $('#search_form').on( "submit", function(event) { 
            event.preventDefault();
            var form = new FormData(this);

            $.ajax({
                url: '/searchimage',
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success:function(response) {
                    console.log(response);
                    var tpl = $('#ajaxImages').html();
                    var output = Mustache.render(tpl, response);
                    var fullpath = '/storage/{{ auth()->user()->site->siteUrl }}/images/thumb_240/';
                    output = replaceAll(output, 'src="', 'src="'+fullpath);
                    $('#image_browse').html(output);
                    //console.log(output);
                    
                },
                error: function(a,b,err) {
                    document.write(a.responseText);
                }
            });
        });
    });
</script>

<script type="mustache/x-tmpl" id="ajaxErrors">
    <div class="alert alert-danger">

        @{{ #photo }}
        @{{.}}
        @{{ /photo }}

    </div>

</script>

<script type="mustache/x-tmpl" id="ajaxImages">

    @{{ #. }}

    <div class="col-sm-6 col-md-3">
        <div class="thumbnail">
            <div class="fixedbox">
                <img src="@{{ picpath }}" class="img-responsive sitepics" id="pic-@{{ id }}" data-sizes="@{{ lg }}-@{{ md }}-@{{ sm }}-@{{ xs }}" data-caption="@{{captions}}" />
            </div>
            <div class="caption">

                @{{ captions }}
            </div>
        </div>
    </div>

    @{{/.}}
</script>
<script>
    /* /*var allimages = "";
        for (var key in response) {
            // skip loop if the property is from prototype
            if (!response.hasOwnProperty(key)) continue;

            var obj = response[key];
            for (var prop in obj) {
                // skip loop if the property is from prototype
                if(!obj.hasOwnProperty(prop)) continue;
                //picpath
                //pic_id
                //lg
                // your code
                console.log(prop + " = " + obj[prop]);
                
            }
        }
        */
    </script>