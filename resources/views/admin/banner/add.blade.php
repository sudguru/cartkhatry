@extends('layouts.admin')

@section('pagetitle')
Add Banner - admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Banner - Add</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-4" style="text-align: center">
            <img src="/assets/images/banner-placeholder.jpg" style="width:100%; margin: 0 auto; cursor: pointer" id="logoImage" />
            <small><em>Click the banner above to Add/Change</em></small>
            <input type="file" name="logo" id="logo" style="display: none" accept="image/x-png,image/gif,image/jpeg"  />
    </div>
    <div class="col-md-8">
        <form action="{{ route('banner.store') }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            <div class="form-group">
                <label for="position">Position <span class="required">*</span></label>
                <select id="position" name="position" class="form-control">
                    <option value="0" data-nt="1" data-nst="1">Select Banner Position</option>
                @foreach ($positions as $position)
                    <option value="{{ $position['name'] }}" data-nt="{{ $position['needsTitle'] }}" data-nst="{{ $position['needsSubtitle'] }}" {{ $position['name'] == old('position') ? 'selected' : '' }}
                        >
                        {{ $position['name'] }}
                    </option>
                @endforeach
                    
                </select>
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
                <input id="subtitle" type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}" name="subtitle"
                    value="{{ old('subtitle') }}" autofocus>

                @if ($errors->has('subtitle'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('subtitle') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input id="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link"
                    value="{{ old('link') }}" autofocus>
                <small id="linkHelp" class="form-text text-muted">Must Start with http:// or https:// but can be empty</small>
                @if ($errors->has('link'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('link') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-footer" style="margin-top: 0; padding-top:0">
                <input type="text" name="banner" id="banner" value="">
                <button type="submit" class="btn btn-primary btn-md">Save Promo</button>
                <a class="btn btn-light btn-md" href="{{ route('banner.index') }}">Cancel</a>
            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection

@section('extrajs')
<script>
    $(document).ready(function() {
        $('#position').change(function(){
            var selected = $(this).find('option:selected');
            var needsTitle = selected.data('nt'); 
            var needsSubtitle = selected.data('nst'); 
            if (needsTitle) {
                $("#title").prop('disabled', false);
            } else {
                $('#title').val('');
                $("#title").prop('disabled', true);
            }
            if (needsTitle) {
                $("#subtitle").prop('disabled', false);
            } else {
                $('#subtitle').val('');
                $("#subtitle").prop('disabled', true);
            }
        });

        $('#logoImage').on('click', function() {
              $('#logo').click();
          });
      
          $('#logo').on('change', function(e) {
            
            var file = document.getElementById('logo').files[0];
            var logo = document.getElementById('logoImage');
            var filename = file.name;
            var reader = new FileReader();
            reader.onload = function(e) {
              
              imageDataURL = e.target.result;
              
              var image = new Image();
              image.src = imageDataURL;
              console.log(image);
              image.onload = function (imageEvent) {
                console.log('iii');
                  // Resize the image
                  var canvas = document.createElement('canvas'),
                      max_size = 300,
                      width = image.width,
                      height = image.height;
                  if (width > height) {
                      if (width > max_size) {
                          height *= max_size / width;
                          width = max_size;
                      }
                  } else {
                      if (height > max_size) {
                          width *= max_size / height;
                          height = max_size;
                      }
                  }
                  canvas.width = width;
                  canvas.height = height;
                  canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                  var dataUrl = canvas.toDataURL('image/jpeg');
                  console.log(dataUrl);


                  $.ajax({
                    type:'POST',
                    url:'/banner/upload',
                    data: { dataUrl : dataUrl, filename: filename },
                    success:function(data){
                        console.log(data);
                        $('#banner').val(data);
                    }
                  });
              }
              
            }
            reader.readAsDataURL(file);
          });
    });
</script>

    
@endsection

