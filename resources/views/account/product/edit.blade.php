@extends('layouts.site')
@section('pagetitle')
Add Images of Product
@endsection

@section('extracss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
<style>
ul#productImages li{
    display: inline-block;
    width: 150px;
    margin-right: 15px;
    margin-bottom: 15px;
}
</style>
@endsection

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>

        </ol>
    </div><!-- End .container -->
</nav>

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <div class="card">
                <div class="card-header">
                    Product Images
                    <a href="#" class="card-edit" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i>
                        &nbsp;Add New Image</a>
                </div>

                <div class="card-body">
                    <ul id="productImages">
                        @foreach($product->pics as $pic)
                            <li data-id="{{ $pic->id }}">
                                <img src="/storage/images/{{auth()->user()->id}}/thumb_240/{{$pic->pic_path}}" style="width: 100%; cursor: move" />
                                <i class="js-remove" style="cursor: pointer ">✖</i>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <h2>Edit Product</h2>
            <form action="{{ route('account.product.update', $product->id) }}" method="POST" autocomplete="off"
                novalidate class="mb-1">
                <div class="form-group">
                    <label for="name">Product Name <span class="required">*</span></label>
                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                        name="name" value="{{ old('name') ?? $product->name }}" autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Category</label>

                            <select class="custom-select" name="category_id" id="category_id">
                                @foreach($categories as $parent)
                                    <option value="{{$parent->id}}" {{$parent->id == $product->category_id ? 'selected': ''}}>{{$parent->category}}</option>
                                    @if($parent->children)
                                        @foreach($parent->children as $child)
                                            <option value="{{$child->id}}" {{$child->id == $product->category_id ? 'selected': ''}}> -- {{$child->category}}</option>
                                            @if($child->children)
                                                @foreach($child->children as $grandchild)
                                                    <option value="{{$grandchild->id}}"  {{$grandchild->id == $product->category_id ? 'selected': ''}}> ---- {{$grandchild->category}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="SKU">SKU <span class="required">*</span></label>
                                    <input type="text" class="form-control{{ $errors->has('SKU') ? ' is-invalid' : '' }}"
                                        id="SKU" name="SKU" value="{{ old('SKU') ?? $product->SKU }}">
                                    @if ($errors->has('SKU'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SKU') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Available Stock <span class="required">*</span></label>
                                    <input type="number" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}"
                                        id="stock" name="stock" value="{{ old('stock') ?? $product->stock }}">
                                    @if ($errors->has('stock'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_order_unit">Min Order Unit<span class="required">*</span></label>
                                    <input type="number" class="form-control" id="min_order_unit" name="min_order_unit"
                                        value="{{ old('min_order_unit') ?? $product->min_order_unit }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_stock_level">Min Stock Level<span class="required">*</span></label>
                                    <input type="number" class="form-control" id="min_stock_level" name="min_stock_level"
                                        value="{{ old('min_stock_level') ?? $product->min_stock_level }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description">Short Description</label>
                        <textarea class="form-control editor" name="description" id="description" style="height: calc(100% - 46px)">{{ old('description') ?? $product->description }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="specification">Detailed Specification</label>
                    <textarea class="form-control editor" name="specification" id="specification">{{ old('specification') ?? $product->specification }}</textarea>
                </div>

                <div class="form-footer" style="margin-top: 0; padding-top:0">
                    <button type="submit" class="btn btn-primary btn-md">Update Product</button>
                </div><!-- End .form-footer -->
                @csrf
                {{ method_field('PUT') }}
            </form>


            <div class="mb-2"></div><!-- margin -->

        </div><!-- End .col-lg-9 -->

        <aside class="sidebar col-lg-3">
            <div class="widget widget-dashboard">
                <h3 class="widget-title">My Account</h3>

                <ul class="list">
                    @include('account.sidebar')
                </ul>
            </div><!-- End .widget -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->


<div class="mb-5"></div><!-- margin -->

@include('uploadimagesimple.imagemanager')


@endsection

@section('extrajs')
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

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {

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

                    // 1. save caption
                    // 2. add image to productimage list
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


@endsection
