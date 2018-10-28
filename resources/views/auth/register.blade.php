@extends('layouts.site')

@section('content')
<div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="title mb-2">Sign Up</h2>
    
                <form action="{{ route('register') }}" method="POST" autocomplete="off" novalidate class="mb-1">
    
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
    
    
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" autofocus>
    
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
                        <label for="password-confirm">Confirm Password</label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
 
                    </div>
    
                    <div class="form-footer" style="margin-top: 0; padding-top:0">
    
                        <button type="submit" class="btn btn-primary btn-md">SIGN UP</button>

                    </div><!-- End .form-footer -->
    
                </form>
            </div>
        </div>
    </div>

@endsection
