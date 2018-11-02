@extends('layouts.admin')

@section('pagetitle')
Settings- Admin
@endsection

@section('extracss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Settings</h2>

</div>

<div class="row justify-content-center mt-3">

    <div class="col-md-10">
        <form action="{{ route('setting.update', $setting->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input id="site_name" type="text" class="form-control{{ $errors->has('site_name') ? ' is-invalid' : '' }}"
                    name="site_name" value="{{ old('site_name') ?? $setting->site_name }}" autofocus>

                @if ($errors->has('site_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('site_name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                    name="address" value="{{ old('address') ?? $setting->address }}">

                @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="phone1">Phone 1</label>
                <input id="phone1" type="text" class="form-control{{ $errors->has('phone1') ? ' is-invalid' : '' }}"
                    name="phone1" value="{{ old('phone1') ?? $setting->phone1 }}">

                @if ($errors->has('phone1'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone1') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="phone2">Phone 2</label>
                <input id="phone2" type="text" class="form-control{{ $errors->has('phone2') ? ' is-invalid' : '' }}"
                    name="phone2" value="{{ old('phone2') ?? $setting->phone2 }}">

                @if ($errors->has('phone2'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone2') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                    value="{{ old('email') ?? $setting->email }}">

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="order_email">Order Email</label>
                <input id="order_email" type="text" class="form-control{{ $errors->has('order_email') ? ' is-invalid' : '' }}"
                    name="order_email" value="{{ old('order_email') ?? $setting->order_email }}">

                @if ($errors->has('order_email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('order_email') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-group">
                <label for="facebook">Facebook</label>
                <input id="facebook" type="text" class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                    name="facebook" value="{{ old('facebook') ?? $setting->facebook }}">

                @if ($errors->has('facebook'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('facebook') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="twitter">Twitter</label>
                <input id="twitter" type="text" class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}"
                    name="twitter" value="{{ old('twitter') ?? $setting->twitter }}">

                @if ($errors->has('twitter'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('twitter') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="youtube">Youtube</label>
                <input id="youtube" type="text" class="form-control{{ $errors->has('youtube') ? ' is-invalid' : '' }}"
                    name="youtube" value="{{ old('youtube') ?? $setting->youtube }}">

                @if ($errors->has('youtube'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('youtube') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="googleplus">Google Plus</label>
                <input id="googleplus" type="text" class="form-control{{ $errors->has('googleplus') ? ' is-invalid' : '' }}"
                    name="googleplus" value="{{ old('googleplus') ?? $setting->googleplus }}">

                @if ($errors->has('googleplus'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('googleplus') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="viber">Viber</label>
                <input id="viber" type="text" class="form-control{{ $errors->has('viber') ? ' is-invalid' : '' }}" name="viber"
                    value="{{ old('viber') ?? $setting->viber }}">

                @if ($errors->has('viber'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('viber') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input id="whatsapp" type="text" class="form-control{{ $errors->has('whatsapp') ? ' is-invalid' : '' }}"
                    name="whatsapp" value="{{ old('whatsapp') ?? $setting->whatsapp }}">

                @if ($errors->has('whatsapp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('whatsapp') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="skype">Skype</label>
                <input id="skype" type="text" class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}" name="skype"
                    value="{{ old('skype') ?? $setting->skype }}">

                @if ($errors->has('skype'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('skype') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                    name="description">
                    {{ old('description') ?? $setting->description }}
                                </textarea>

                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-footer" style="margin-top: 0; padding-top:0">
                <button type="submit" class="btn btn-primary btn-md">Save Outlet</button>
                <a class="btn btn-light btn-md" href="{{ route('setting.index') }}">Cancel</a>
            </div><!-- End .form-footer -->

        </form>

    </div>
</div>
@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {
        $('#description').summernote({
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
    });

</script>


<script>
    function initMap() {
        var l = {
            {
                $setting - > lat
            }
        };
        var n = {
            {
                $setting - > lng
            }
        };
        var ktm = {
            lat: l,
            lng: n
        };
        var map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 15,
                center: ktm
            });
        var marker = new google.maps.Marker({
            position: ktm,
            map: map,
            draggable: true
        });
        google.maps.event.addListener(marker, "dragend", function (event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            $("#lat").val(lat);
            $("#lng").val(lng);
            map.setCenter({
                lat: lat,
                lng: lng
            });
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM56_qNOsN6oNmaRapcWK5rZbFK69K6co&callback=initMap"
    async defer></script>
@endsection
