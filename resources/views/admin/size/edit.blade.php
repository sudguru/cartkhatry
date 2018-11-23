@extends('layouts.admin')

@section('pagetitle')
Add New Size - Admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Size - Edit</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('size.update', $size->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="size">Size</label>
                <input id="size" type="text" class="form-control{{ $errors->has('size') ? ' is-invalid' : '' }}" name="size"
                    value="{{ old('size') ?? $size->size }}" autofocus>

                @if ($errors->has('size'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('size') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Size</button>
                <a class="btn btn-light btn-md" href="{{ route('size.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
