@extends('layouts.d11')
@section('pagetitle')
Check Out | {{$setting->site_name}}
@endsection

@section('extracss')

@endsection

@section('content')
@php
$cur = session('currency') ?? 'NPR';
$addtocarttext = "Add to Cart";
@endphp
<nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <ul class="checkout-progress-bar">
            <li class="active">
                <span>Shipping</span>
            </li>
            {{-- <li>
                <span>Review &amp; Payments</span>
            </li> --}}
        </ul>
        <div class="row">
            <div class="col-lg-7">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Shipping Address</h2>
                        @guest
                        <form action="{{ route('login') }}" method="POST" autocomplete="off" novalidate class="mb-1">

                                @csrf
                                <div class="alert alert-info">
                                    If you already have account with us please Login, or you can continue as guest below.
                                </div>
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
                        @else
                        <div class="alert alert-info">
                            <strong>You are logged in as {{Auth::user()->email}}. Not Your Account? Sign Out and Login with your account.</strong>
                        </div>
                        @endguest

                        <form action="{{ route('cartorder')}}" method="POST" autocomplete="off" class="mb-1">
                            @csrf
                            
                            <div class="form-group required-field">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ Auth::user()->email ?? '' }}" required autofocus>
            
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                           
                            <div class="form-group required-field">
                                <label>Full Name </label>
                                <input type="text" name="name"  class="form-control" value="{{Auth::user()->name ?? ''}}" required>
                            </div><!-- End .form-group -->


                            <div class="form-group">
                                <label>Company </label>
                                <input type="text" name="company" class="form-control" value="{{Auth::user()->userdetail->company_name ?? ''}}">
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Street Address </label>
                                <input type="text" name="address" class="form-control" value="{{Auth::user()->userdetail->address ?? ''}}" required>
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>City  </label>
                                <input type="text" name="city" class="form-control" value="{{Auth::user()->userdetail->city ?? ''}}" required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>State/Province</label>
                                <input type="text" name="state" class="form-control" value="{{Auth::user()->userdetail->state ?? ''}}" required>
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Zip/Postal Code </label>
                                <input type="text" name="postalcode" class="form-control" value="{{Auth::user()->userdetail->postal_code ?? ''}}"  required>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Country</label>
                                <div class="select-custom">

                                    <select name="country" id="country" class="form-control">
                                        @foreach($countries as $country)
                                        <option value="{{$country->name}}" {{ trim($country->name) == (Auth::user()->userdetail->country?? 'Nepal') ? 'selected' : ''}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Mobile/Phone Number </label>
                                <div class="form-control-tooltip">
                                    <input type="text" name="phone" class="form-control" value="{{Auth::user()->userdetail->mobile ?? ''}}" required>
                                </div><!-- End .form-control-tooltip -->
                            </div><!-- End .form-group -->
                            <div class="alert alert-info">
                                Current Payment Method is <strong>Cash On Delivery</strong>. <br/>
                                Other Payments methods as ESewa, PayPal, Credit Card Checkout are coming soon..
                            </div>

                            <div class="checkout-steps-action">
                                    <button type="submit" class="btn btn-primary btn-md">Place Your Order</button>
                            </div><!-- End .checkout-steps-action -->
     
                        </form>
                    </li>

                    {{-- <li>
                        <div class="checkout-step-shipping">
                            <h2 class="step-title">Shipping Methods</h2>

                            <table class="table table-step-shipping">
                                <tbody>
                                    <tr>
                                        <td><input type="radio" name="shipping-method" value="flat"></td>
                                        <td><strong>$20.00</strong></td>
                                        <td>Fixed</td>
                                        <td>Flat Rate</td>
                                    </tr>

                                    <tr>
                                        <td><input type="radio" name="shipping-method" value="best"></td>
                                        <td><strong>$15.00</strong></td>
                                        <td>Table Rate</td>
                                        <td>Best Way</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- End .checkout-step-shipping -->
                    </li> --}}
                </ul>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-5">
                <div class="order-summary">
                    <h3>Summary</h3>

                    <h4>
                        <a data-toggle="collapse" href="#order-cart-section" class="" role="button" aria-expanded="true" aria-controls="order-cart-section">{{session('cart')->totalQty}} products selected</a>
                    </h4>
                    <div class="collapse show" id="order-cart-section">
                        @php
                        $total = 0;
                        @endphp
                        
                        <table class="table table-mini-cart">
                            <tbody>
                                @foreach(session('cart')->items as $item)
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="/product/{{$item['item']->slug}}" class="product-image">
                                                {!!$item['item']->pic!!}
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a href="/product/{{$item['item']->slug}}">{{$item['item']->name}}</a>
                                            </h2>
                                            @php
                                            $itemcurrency = $item['item']->currency;
                                            $itemprice = round(($item['item']->price/$exchangerates->$itemcurrency) * $exchangerates->$cur, 2);
                                            $itemtotal = round((($item['item']->price * $item['qty'])/$exchangerates->$itemcurrency) * $exchangerates->$cur, 2);
                                            $total = $total + $itemtotal;
                                        @endphp
                                            <span class="product-qty">Qty: {{$item['qty']}} x {{$cur }} {{number_format($itemprice,2)}}</span>
                                            
                                        </div>
                                    </td>
                                    <td class="price-col">
  
                                        {{$cur }} {{number_format($itemtotal,2)}} <br>
                                        <span class="text-muted">Size:</span> <span style="color: #880000">{{$item['item']->size}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="font-weight: bold">Total</td>
                                    <td style="font-weight: bold">{{$cur}} {{number_format($total,2)}}</td>
                                </tr>
                            </tbody>    
                        </table>
                        
                    </div><!-- End #order-cart-section -->
                </div><!-- End .order-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->

        
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
@endsection

@section('extrajs')

@endsection
