@extends('layouts.admin')

@section('pagetitle')
Edit Content Type - admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Content Type - Edit</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('contenttype.update', $contenttype->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="contenttype">Content Type</label>
                <input id="contenttype" type="text" class="form-control{{ $errors->has('contenttype') ? ' is-invalid' : '' }}" name="contenttype"
                    value="{{ old('contenttype') ?? $contenttype->contenttype }}" autofocus>

                @if ($errors->has('contenttype'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('contenttype') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="icon">Icon</label>
                <input id="icon" type="text" class="form-control{{ $errors->has('icon') ? ' is-invalid' : '' }}" name="icon"
                    value="{{ old('icon') ?? $contenttype->icon }}" autofocus>

                @if ($errors->has('icon'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('icon') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Promo</button>
                <a class="btn btn-light btn-md" href="{{ route('contenttype.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
        <hr/>
        @include('utils.faicons')
    </div>
</div>
@endsection

@section('extrajs')
<script defer>
    $(document).ready(function() {
        $('.icon-holder').on('click', function(e) {
            $('#icon').val(e.target.className);
        });
    })
</script>
    
@endsection