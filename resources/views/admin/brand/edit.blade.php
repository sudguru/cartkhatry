@extends('layouts.admin')

@section('pagetitle')
Edit Brand - Admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Brand - Edit</h2>
</div>
{{$errors}}
<form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data" id="thisForm"
    autocomplete="off" novalidate class="mb-1">

    @csrf
    {{ method_field('PUT') }}

    <div class="row justify-content-center mt-3">
        <div class="col-md-4" style="text-align: center">
            @php
                $photo = $brand->pic_path;
                if(!$photo) {
                    $photo = '/assets/images/banner-placeholder.jpg';
                } else {
                    $photo = '/storage/brands/' . $photo;
                }
            @endphp
            <img src="{{$photo}}" style="width:100%; margin: 0 auto; cursor: pointer" id="picImage" />
            <small><em>Click the image above to Edit/Change</em></small>
            <input type="file" name="pic_path" id="pic_path" class="{{ $errors->has('pic_path') ? 'is-invalid' : '' }}"
                style="display: none" accept="image/x-png,image/gif,image/jpeg" />
            @if ($errors->has('pic_path'))
            <span class="required" role="alert">
                <br><strong>{{ $errors->first('pic_path') }}</strong>
            </span>
            @endif
        </div>

        <div class="col-md-8">

            <div class="form-group">
                <label for="brand">Brand</label>
                <input id="brand" type="text" class="form-control{{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand"
                    value="{{ old('brand') ?? $brand->brand }}" autofocus>

                @if ($errors->has('brand'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('brand') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                    name="description" value="{{ old('description') ?? $brand->description }}">

                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-footer" style="margin-top: 0; padding-top:0">
                <button type="submit" class="btn btn-primary btn-md">Update Brand</button>
                <a class="btn btn-light btn-md" href="{{ route('brand.index') }}">Cancel</a>
            </div><!-- End .form-footer -->
        </div>
    </div>
</form>


@endsection

@section('extrajs')
<script>
    $(document).ready(function () {



        $('#picImage').on('click', function () {
            $('#pic_path').click();
        });

        $('#pic_path').on('change', function (e) {

            var file = document.getElementById('pic_path').files[0];
            var picImage = document.getElementById('picImage');
            var reader = new FileReader();
            reader.onload = function (e) {
                imageDataURL = e.target.result;
                picImage.src = imageDataURL;
            }
            reader.readAsDataURL(file);
        });

    });

</script>


@endsection
