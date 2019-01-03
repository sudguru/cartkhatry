@extends('layouts.d11')

@section('pagetitle')
    Login
@endsection
@section('content')
<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="title mb-2">Login</h2>

            <form action="{{ route('login') }}" method="POST" autocomplete="off" novalidate class="mb-1">

                @csrf

                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="custom-control-login-checkbox custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="rememberd"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label form-footer-right" for="rememberd">Remember Me</label>
                </div>


                <div class="form-footer" style="margin-top: 0; padding-top:0">

                    <button type="submit" class="btn btn-primary btn-md">LOGIN</button>

                    <div class="form-footer-right">


                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div><!-- End .form-footer -->

            </form>
        </div>
    </div>
</div>

@endsection
