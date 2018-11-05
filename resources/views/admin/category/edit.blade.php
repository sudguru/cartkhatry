@extends('layouts.admin')

@section('pagetitle')
Edit Category - admin
@endsection

@section('extracss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Category - Edit</h2>

</div>

<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}

  

            <div class="form-group">
                <label for="category">Category</label>
                <input id="category" type="text" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" name="category"
                    value="{{ old('category') ?? $category->category }}" autofocus>

                @if ($errors->has('category'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('category') }}</strong>
                </span>
                @endif
            </div>
            @php
                if (strlen($category->banner) > 4) {
                    $src = "/storage/banners/category/$category->banner";
                } else {
                    $src = "/assets/images/category-banner-placeholder.jpg";
                }
            @endphp
            <div class="form-group">
                    <img src="{{$src}}" style="width:100%; margin: 0 auto; cursor: pointer" id="picImage" />
                    <small><em>Click the banner above to Add/Change</em></small>
                    <input type="file" name="banner" id="banner" class="{{ $errors->has('banner') ? 'is-invalid' : '' }}" style="display: block" accept="image/x-png,image/gif,image/jpeg" />
                    @if ($errors->has('banner'))
                    <span class="required" role="alert">
                        <br><strong>{{ $errors->first('banner') }}</strong>
                    </span>
                    @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">
                    {{ old('description') ?? $category->description }}
                                </textarea>

                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save category</button>
                <a class="btn btn-light btn-md" href="{{ route('category.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {

        $('#picImage').on('click', function () {
            $('#banner').click();
        });

        $('#banner').on('change', function (e) {
            var file = document.getElementById('banner').files[0];
            var picImage = document.getElementById('picImage');
            var reader = new FileReader();
            reader.onload = function (e) {
                imageDataURL = e.target.result;
                picImage.src = imageDataURL;
            }
            reader.readAsDataURL(file);
        });
        
        $('#description').summernote({
            height: 150,
            toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link','picture', 'video', 'table', 'hr']],
            ['height', ['height']],
            ['fullscreen']
        ]
        });
    });

</script>


@endsection

