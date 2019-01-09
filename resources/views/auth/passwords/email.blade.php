@extends('layouts.d11')

@section('pagetitle')
    Reset Your Password
@endsection

@section('content')

<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="title mb-2">Forgot / Change Password</h2>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" autocomplete="off" novalidate class="mb-1">

                @csrf
                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group mb-0">

                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

@endsection
