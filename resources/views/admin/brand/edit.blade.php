@extends('layouts.admin')

@section('pagetitle')
Add New Banner - admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Banner - Edit</h2>

</div>

<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('banner.update', $banner->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}

            @php
            if(old('bannertype_id')):
                $selectedBannerTypeId = old('bannertype_id');
            else:
                $selectedBannerTypeId = $banner->bannertype_id;
            endif
            @endphp
            <div class="form-group">
                <label for="bannertype_id">Banner Type <span class="required">*</span></label>
                <select id="bannertype_id" name="bannertype_id" class="form-control{{ $errors->has('bannertype_id') ? ' is-invalid' : '' }}">
                    <option value="0" data-nt="1" data-nst="1">Select Banner Position</option>
                    @foreach ($bannertypes as $bannertype)
                    <option value="{{ $bannertype->id }}" data-nt="{{ $bannertype->needsTitle }}" data-nst="{{ $bannertype->needsSubtitle }}"
                        {{ $bannertype->id == $selectedBannerTypeId  ? 'selected' : '' }}
                        >
                        {{ $bannertype->bannertype }}
                    </option>
                    @endforeach

                </select>
                @if ($errors->has('position'))
                
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                    value="{{ old('title') ?? $banner->title }}">

                @if ($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="subtitle">Subitle</label>
                <input id="subtitle" type="text" class="form-control{{ $errors->has('subtitle') ? ' is-invalid' : '' }}"
                    name="subtitle" value="{{ old('subtitle') ?? $banner->subtitle }}">

                @if ($errors->has('subtitle'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('subtitle') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input id="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link"
                    value="{{ old('link') ?? $banner->link }}" autofocus>
                <small id="linkHelp" class="form-text text-muted">asdfadsf a {{$banner->bannertype_id}} Must Start with http:// or https:// but can be empty</small>
                @if ($errors->has('link'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('link') }}</strong>
                </span>
                @endif
            </div>




            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Banner</button>
                <a class="btn btn-light btn-md" href="{{ route('banner.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
@section('extrajs')

<script>
    $(document).ready(function () {
        //at page load
        

        $('#bannertype_id').on('change',function () {
            var selected = $(this).find('option:selected');
            var needsTitle = selected.data('nt');
            var needsSubtitle = selected.data('nst');
            enableDisable(needsTitle, needsSubtitle);
        });
        var bannertypeid = {{$banner->bannertype_id}};

        $('#bannertype_id').val(bannertypeid).trigger('change');
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
            $('#banner').click();
        });

        $('#banner').on('change', function (e) {

            var file = document.getElementById('banner').files[0];
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