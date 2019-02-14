@extends('layouts.d11')
@section('pagetitle')
    Account Information
@endsection
@section('extracss')
  <link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
@endsection
@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div><!-- End .container -->
</nav>

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">

                <h2>Edit Account Information</h2>

                <form action="{{ route('account.info') }}" method="POST">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group" style="font-weight: bold">
                                <label for="email">Email:</label>
                                {{Auth::user()->email}}
                            </div>

                            <label for="name">Full Name <span class="required">*</span></label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                name="name" value="{{ old('name') ?? Auth::user()->name }}" autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>


                    <div class="row">
                            <div class="col-md-6">
                                <strong>Billing info</strong>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$userdetail->address}}">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{$userdetail->city}}">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{$userdetail->state}}">
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                        value="{{$userdetail->postal_code}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br />
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" value="{{$userdetail->country}}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{$userdetail->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{$userdetail->mobile}}">
                                </div>
                                <div class="form-group">
                                    <label for="website">Web Site</label>
                                    <input type="text" class="form-control" id="website" name="website" value="{{$userdetail->website}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Other info</strong>
                                <div class="form-group">
                                    <label for="skype">Skype</label>
                                    <input type="text" class="form-control" id="skype" name="skype" value="{{$userdetail->skype}}">
                                </div>
                                <div class="form-group">
                                    <label for="viber">Viber</label>
                                    <input type="text" class="form-control" id="viber" name="viber" value="{{$userdetail->viber}}">
                                </div>
                                <div class="form-group">
                                    <label for="whatsapp">WhatsApp</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{$userdetail->whatsapp}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br />
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{$userdetail->facebook}}">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{$userdetail->twitter}}">
                                </div>
                                <div class="form-group">
                                    <label for="youtube">You Tube</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{$userdetail->youtube}}">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="color: #cc0000">For Merchants Only (Those who wants to sell)</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Payment Instruction</strong>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="paymentlink" name="paymentlink" value="{{$userdetail->paymentlink}}">
                                    <small>If you are an independent vendor, then enter the payment instructions or a link.</small> <br>
                                    <small><span style="font-weight: bold">Example 1:</span> Complete the Order now and then you can transfer money to my Nabil Bank Account. Account Name: YourName YourCast, A/C# 123456789123, Durbarmarg Branch</small>
                                    <br/>
                                    <small><span style="font-weight: bold">Example 2:</span> Complete the Order now and then go to www.esewa.com.np and transfer the Amount to my ESewa Account: 94717777777 (your esewa id). </small>
                                    <br/>
                                    <small><span style="font-weight: bold">Example 3:</span> Complete the Order now and then go to www.paypal.com and transfer the Amount to my PayPal Account: your@email.com (PayPal id). </small>
                                    <br/>
                                    <small><span style="font-weight: bold">Example 4:</span> Complete the Order now and we will contact you as soon as possible. You will make the payment on delivery. </small>
                                </div>
                            </div>
                        </div>
  

                    <div class="form-footer">

                        <div class="form-footer-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div><!-- End .form-footer -->
                    @csrf
                </form>
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">My Account</h3>

                    <ul class="list">
                        @include('account.sidebar')
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->


<div class="mb-5"></div><!-- margin -->
@endsection

@section('extrajs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
  $(document).ready(function() {
      $('#description').summernote({
          height: 150,
          toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link','picture', 'video', 'table', 'hr']],
          ['height', ['height']],
          ['fullscreen']
      ]
      });
  });
</script>
<script>
    var x = document.getElementById("snackbar");
    if (x) {
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    } 
</script>
@endsection