@extends('layouts.admin')

@section('pagetitle')
Add New Content Type - Admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Content Type - Add</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('contenttype.store') }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf

            <div class="form-group">
                <label for="contenttype">Content Type</label>
                <input id="contenttype" type="text" class="form-control{{ $errors->has('contenttype') ? ' is-invalid' : '' }}" name="contenttype"
                    value="{{ old('contenttype') }}" autofocus>

                @if ($errors->has('contenttype'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('contenttype') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Content Type</button>
                <a class="btn btn-light btn-md" href="{{ route('contenttype.index') }}">Cancel</a>
            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
