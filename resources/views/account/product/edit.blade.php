@extends('layouts.site')
@section('pagetitle')
Add Images of Product
@endsection

@section('extracss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
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
                    <div class="row">
                        <div class="col-md-2">
                            <div style="background-color: #ddd">Image</div>
                        </div>
                        <div class="col-md-2">
                            Image
                        </div>
                        <div class="col-md-2">
                            Image
                        </div>
                    </div>
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
                                <option value="{{$parent->id}}">{{$parent->category}}</option>
                                @if($parent->children)
                                @foreach($parent->children as $child)
                                <option value="{{$child->id}}"> -- {{$child->category}}</option>
                                @if($child->children)
                                @foreach($child->children as $grandchild)
                                <option value="{{$grandchild->id}}"> ---- {{$grandchild->category}}</option>
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

@include('account.upload.imagemanager')
{{-- <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="imageModalLabel">Upload Product Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div style="text-align: center">
                    <img src="/assets/images/product-placeholder.png" style="width: 300px; margin: 0 auto" id="prodImagePic" />
                </div>
            </div>
            <div class="modal-footer">
                <input type="file" name="prodImage" id="prodImage" style="display: none" accept="image/x-png,image/gif,image/jpeg" />
                <button type="button" class="btn btn-primary" id="picButton">Select Image</button>
                <button type="submit" class="btn btn-success">Upload</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@section('extrajs')
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
                    console.log(response);

                    var featured = $("input[name='featured']:checked").val();
                    if (featured == 1)
                        $('#featured_pic_id').val($('#pic_id').val()); //for page save
                    var element = CKEDITOR.dom.element.createFromHtml(response);
                    CKEDITOR.instances.content.insertElement(element);
                    //Close
                    $('#myModal').modal('hide');
                },
                error: function (a, b, err) {
                    document.write(a.responseText);
                }
            });

        });





        $('#upload_form').on("submit", function (event) {
            $('#imageHolder').html('<img src="/assets/images/blueloading.gif"/>');
            $('#lg').attr('disabled', false);
            $('#md').attr('disabled', false);
            $('#sm').attr('disabled', false);
            $('#xs').attr('disabled', false);
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
                    //alert('hello');
                    var obj = JSON.parse(response);

                    if (obj.lg == "0") $('#lg').attr('disabled', true);
                    if (obj.md == "0") $('#md').attr('disabled', true);
                    if (obj.sm == "0") $('#sm').attr('disabled', true);
                    if (obj.xs == "0") $('#xs').attr('disabled', true);

                    $('#imageHolder').html('<img src="' + obj.path + '" class="img-responsive"/>');
                    $('#pic_id').val(obj.pic_id); //for caption save
                    $('#pic_name').val(obj.basename);
                    $('#btnInsert').show();
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    //var errors = data.responseText;
                    $('#imageHolder').html(
                        '<img src="/assets/images/product-placeholder.png" class="img-responsive" />'
                    );

                    console.log(errors);
  
                }
            });
        });
    });

</script>


@endsection
