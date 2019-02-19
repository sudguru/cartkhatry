@extends('layouts.d11')
@section('pagetitle')
{{$product->name}} | {{$setting->site_name}}
@endsection

@section('extracss')

@endsection

@section('content')
@php
$cur = session('currency') ?? 'NPR';
$addtocarttext = "Add to Cart";
if($product->paymentmanagedby == 'Self') $addtocarttext="Direct Order";
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

                        <form action="{{ route('directorder', [$product->slug,$price->id,$qty] ) }}" method="POST" autocomplete="off" class="mb-1">
                            @csrf
                            
                            <div class="form-group required-field">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email')?? Auth::user()->email }}" required autofocus>
            
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

                            <div class="alert alert-warning">
                                    IMPORTANT:<br/>
                                    <strong>This Product is not handled by {{$setting->site_name}}.</strong><br/> 
                                    You agree and understand that {{$setting->site_name}} is NOT involved in transaction of this particular product. 
                                    You are directly dealing with the party who has posted the Product, and agree not to hold {{$setting->site_name}} responsible for their act in any circumstances. We strongly encourage you to take necessary precaution.
                                    
                            </div>

                            <div class="checkout-steps-action">
                                    <button type="submit" class="btn btn-primary btn-md">Place Direct Order</button>
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
                        <a data-toggle="collapse" href="#order-cart-section" class="" role="button" aria-expanded="true" aria-controls="order-cart-section">{{$qty}} products selected</a>
                    </h4>
                    @php
                        if(count($product->pics) > 0) {
                            $image_path = '<img src="/storage/images/'.$product['user_id'].'/thumb_400'.'/' . $product->pics->first()->pic_path .'" />';
                        } else {
                            $image_path = "&nbsp;";
                        }
                        $regular = $product->prices->min('regular');
                        $discounted = $product->prices->min('discounted');
                    @endphp
                    <div class="collapse show" id="order-cart-section">
                        <table class="table table-mini-cart">
                            <tbody>
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="/product/{{$product['slug']}}" class="product-image">
                                                {!!$image_path!!}
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a href="product.html">{{$product->name}}</a>
                                            </h2>

                                            <span class="product-qty">Qty: {{$qty}}</span>
                                        </div>
                                    </td>
                                    <td class="price-col">
                                        @php 
                                            $productCurrency = $product['primarycurrency'];
                                        @endphp
                                        {{ $cur }} {{ round(($regular/$exchangerates->$productCurrency) * $exchangerates->$cur, 2) * $qty }}
                                        <span class="product-qty">@ {{round(($regular/$exchangerates->$productCurrency) * $exchangerates->$cur, 2)}}</span>
                                    </td>
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
    <script>
        $(document).ready(function(){


            $('.pricelink').on('click', function(){
                var d = $(this).data('discounted');
                var r = $(this).data('regular');
                var s = $(this).data('stock');
                $('.product-price').html("{{$cur}}"+ " " + d);
                $('.old-price').html(r);
                $(this).parent().siblings().removeClass('active');
                $(this).parent().addClass('active');
                if(s !== 1) {
                    $('#stock_not_available').text('Out of Stock! Please try another size.')
                    $('.btn-add-to-cart').hide();
                } else {
                    $('#stock_not_available').text('');
                    $('.btn-add-to-cart').show();    
                }
            });
        });
    </script>
@endsection
