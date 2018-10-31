@extends('layouts.admin')

@section('pagetitle')
Add New Banner Type - Admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Banner Type - Add</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('bannertype.store') }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf

            <div class="form-group">
                <label for="bannertype">Banner Type</label>
                <input id="bannertype" type="text" class="form-control{{ $errors->has('bannertype') ? ' is-invalid' : '' }}" name="bannertype"
                    value="{{ old('bannertype') }}" autofocus>

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
                    {{ old('needsTitle') == 1 ? 'checked' : '' }}>
                <label for="needsTitle">Needs Subtitle Title</label>
                <input 
                    style="display: inline-block; margin-left:20px;"
                    id="needsSubtitle" 
                    name="needsSubtitle" 
                    type="checkbox" 
                    value="1" 
                    {{ old('needsSubtitle') == 1 ? 'checked' : '' }}>

            </div>

            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Banner Type</button>
                <a class="btn btn-light btn-md" href="{{ route('bannertype.index') }}">Cancel</a>
            </div><!-- End .form-footer -->

        </form>

    </div>
</div>
@endsection
