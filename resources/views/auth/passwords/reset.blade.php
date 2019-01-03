@extends('layouts.d11')
@section('pagetitle')
    Reset Your Password
@endsection
@section('content')

<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="title mb-2">Reset Password</h2>

            <form action="{{ route('password.update') }}" method="POST" autocomplete="off" novalidate class="mb-1">

                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ $email ?? old('email') }}" autofocus>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>


                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password">

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm
                        Password</label>


                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>

                <div class="form-group mb-0">

                    <button type="submit" class="btn btn-primary">
                        {{ __('Reset Password') }}
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

@endsection
