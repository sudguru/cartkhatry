@extends('layouts.admin')

@section('pagetitle')
Add Product List - Admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Product List - Add</h2>
</div>

    <form action="{{ route('productlist.store') }}" method="POST" autocomplete="off" novalidate class="mb-1">
        @csrf
        <div class="row justify-content-center mt-3">
        @php
        if(old('listname')):
            $selectedlistname = old('listname');
        else:
            $selectedlistname = $listname;
        endif
        @endphp
        <div class="col-md-12">
            <div class="form-group">
                <label for="listname">List Name<span class="required">*</span></label>
                <select id="listname" name="listname" class="form-control{{ $errors->has('listname') ? ' is-invalid' : '' }}">
                    <option value="0">List Name</option>
                    <option value="new" {{ $selectedlistname == 'new' ? 'selected' : '' }}>New</option>
                    <option value="featured" {{ $selectedlistname == 'featured' ? 'selected' : '' }}>Featured</option>
                </select>
                @if ($errors->has('listname'))
                
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('listname') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                    value="{{ old('title') }}" autofocus>

                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="subtitle">Subitle</label>
                <input id="subtitle" type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}"
                    name="subtitle" value="{{ old('subtitle') }}">

                @if ($errors->has('subtitle'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('subtitle') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input id="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link"
                    value="{{ old('link') }}">
                <small id="linkHelp" class="form-text text-muted">Must Start with http:// or https:// but can be empty</small>
                @if ($errors->has('link'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('link') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-footer" style="margin-top: 0; padding-top:0">
                <button type="submit" class="btn btn-primary btn-md">Save Promo</button>
                <a class="btn btn-light btn-md" href="{{ route('productlist.index') }}?listname={{$listname}}">Cancel</a>
            </div><!-- End .form-footer -->
        </div>
    </div>
    </form>


@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
        //at page load
        

        $('#listname').on('change',function () {
            var selected = $(this).find('option:selected');
            var needsTitle = selected.data('nt');
            var needsSubtitle = selected.data('nst');
            enableDisable(needsTitle, needsSubtitle);
        });
        $('#listname').val('{{$listname}}').trigger('change');
        function enableDisable(needsTitle, needsSubtitle) {
            if (needsTitle) {
                $("#title").prop('disabled', false);
            } else {
                // $('#title').val('');
                $("#title").prop('disabled', true);
            }
            if (needsTitle) {
                $("#subtitle").prop('disabled', false);
            } else {
                // $('#subtitle').val('');
                $("#subtitle").prop('disabled', true);
            }
        }

        $('#picImage').on('click', function () {
            $('#productlist').click();
        });

        $('#productlist').on('change', function (e) {

            var file = document.getElementById('productlist').files[0];
            var picImage = document.getElementById('picImage');
            var reader = new FileReader();
            reader.onload = function (e) {
                imageDataURL = e.target.result;
                picImage.src = imageDataURL;
                //   var image = new Image();
                //   image.src = imageDataURL;
                //   image.onload = function (imageEvent) {
                //       // Resize the image
                //       var canvas = document.createElement('canvas'),
                //           max_size = 300,
                //           width = image.width,
                //           height = image.height;
                //       if (width > height) {
                //           if (width > max_size) {
                //               height *= max_size / width;
                //               width = max_size;
                //           }
                //       } else {
                //           if (height > max_size) {
                //               width *= max_size / height;
                //               height = max_size;
                //           }
                //       }
                //       canvas.width = width;
                //       canvas.height = height;
                //       canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                //       var dataUrl = canvas.toDataURL('image/jpeg');

                // }

            }
            reader.readAsDataURL(file);
        });

    });

</script>


@endsection
