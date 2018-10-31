@extends('layouts.admin')

@section('pagetitle')
Edit Banner Type - admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Banner Type - Edit</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('bannertype.update', $bannertype->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="bannertype">Banner Type</label>
                <input id="bannertype" type="text" class="form-control{{ $errors->has('bannertype') ? ' is-invalid' : '' }}" name="bannertype"
                    value="{{ old('bannertype') ?? $bannertype->bannertype }}" autofocus>

                @if ($errors->has('bannertype'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('bannertype') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="needsTitle">Needs Title</label>
                <input 
                    style="display: inline-block; margin-left:20px; margin-right: 60px"
                    id="needsTitle" 
                    name="needsTitle" 
                    type="checkbox" 
                    value="1" 
                    {{ (old('needsTitle') == 1 || $bannertype->needsTitle == 1) ? 'checked' : '' }}>
                <label for="needsTitle">Needs Subtitle Title</label>
                <input 
                    style="display: inline-block; margin-left:20px;"
                    id="needsSubtitle" 
                    name="needsSubtitle" 
                    type="checkbox" 
                    value="1" 
                    {{ (old('needsSubtitle') == 1 || $bannertype->needsSubtitle == 1) ? 'checked' : '' }}>

            </div>

            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Promo</button>
                <a class="btn btn-light btn-md" href="{{ route('bannertype.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
