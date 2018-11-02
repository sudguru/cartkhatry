@extends('layouts.admin')

@section('pagetitle')
Edit Outlet- Admin
@endsection

@section('extracss')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Outlet- Edit</h2>

</div>

<div class="row justify-content-center mt-3">

    <div class="col-md-10">
        <form action="{{ route('outlet.update', $outlet->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="outlet">Outlet <span class="required">*</span></label>
                <input id="outlet" type="text" class="form-control{{ $errors->has('outlet') ? ' is-invalid' : '' }}"
                    name="outlet" value="{{ old('outlet') ?? $outlet->outlet }}" autofocus>

                @if ($errors->has('outlet'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('outlet') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="contact_person">Contact Person <span class="required">*</span></label>
                <input id="contact_person" type="text" class="form-control{{ $errors->has('contact_person') ? ' is-invalid' : '' }}"
                    name="contact_person" value="{{ old('contact_person') ?? $outlet->contact_person }}">

                @if ($errors->has('contact_person'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('contact_person') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                    name="address" value="{{ old('address') ?? $outlet->address }}">

                @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                    value="{{ old('phone') ?? $outlet->phone }}">

                @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                    value="{{ old('email') ?? $outlet->email }}">

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="viber">Viber</label>
                <input id="viber" type="text" class="form-control{{ $errors->has('viber') ? ' is-invalid' : '' }}" name="viber"
                    value="{{ old('viber') ?? $outlet->viber }}">

                @if ($errors->has('viber'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('viber') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input id="whatsapp" type="text" class="form-control{{ $errors->has('whatsapp') ? ' is-invalid' : '' }}"
                    name="whatsapp" value="{{ old('whatsapp') ?? $outlet->whatsapp }}">

                @if ($errors->has('whatsapp'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('whatsapp') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="skype">Skype</label>
                <input id="skype" type="text" class="form-control{{ $errors->has('skype') ? ' is-invalid' : '' }}" name="skype"
                    value="{{ old('skype') ?? $outlet->skype }}">

                @if ($errors->has('skype'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('skype') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">
                    {{ old('description') ?? $outlet->description }}
                                </textarea>

                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                    <div id="map" style="width: 100%; height: 400px;"></div>
            </div>

            <div class="form-footer" style="margin-top: 0; padding-top:0">
                <input type="hidden" id="lat" name="lat" value="{{ old('lat') ?? $outlet->lat }}">
                <input type="hidden" id="lng" name="lng" value="{{ old('lng') ?? $outlet->lng }}">
                <button type="submit" class="btn btn-primary btn-md">Save Outlet</button>
                <a class="btn btn-light btn-md" href="{{ route('outlet.index') }}">Cancel</a>
            </div><!-- End .form-footer -->

        </form>

    </div>
</div>
@endsection
@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function() {
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

  
  <script>


        function initMap() {
        var l = {{ $outlet->lat }};
        var n = {{ $outlet->lng }};
        var ktm = {lat: l, lng: n};
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: ktm});
        var marker = new google.maps.Marker({position: ktm, map: map, draggable: true});
        google.maps.event.addListener(marker, "dragend", function(event) { 
          var lat = event.latLng.lat(); 
          var lng = event.latLng.lng(); 
            $("#lat").val(lat);
            $("#lng").val(lng);
            map.setCenter({lat:lat, lng:lng});
        }); 
        }

        
      </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM56_qNOsN6oNmaRapcWK5rZbFK69K6co&callback=initMap"
    async defer></script>
@endsection

