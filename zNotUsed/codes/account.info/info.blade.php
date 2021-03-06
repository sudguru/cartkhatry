@extends('layouts.site')
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


                    <div class="checkout-discount">
                        <h4>
                            <a data-toggle="collapse" href="#address-section" class="collapsed" role="button"
                                aria-expanded="false" aria-controls="address-section" style="color: green">Address</a>
                        </h4>

                        <div class="collapse" id="address-section">
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
                                        <label for="fax">Fax</label>
                                        <input type="text" class="form-control" id="fax" name="fax" value="{{$userdetail->fax}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Web Site</label>
                                        <input type="text" class="form-control" id="website" name="website" value="{{$userdetail->website}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-discount">
                        <h4>
                            <a data-toggle="collapse" href="#merchant-info-section" class="collapsed" role="button"
                                aria-expanded="false" aria-controls="checkout-discount-section" style="color: green">Additional
                                Info for Merchants</a>
                        </h4>

                        <div class="collapse" id="merchant-info-section">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="company_name" class="form-control" id="company_name" name="company_name"
                                    value="{{$userdetail->company_name}}" />
                            </div>
                            <div class="form-group">
                                <strong>Payment Methods </strong>
                                <div class="form-group-custom-control row" style="padding: 0 15px">

                                    @foreach($paymentmethods as $paymentmethod)
                                    <div class="custom-control custom-checkbox col-md-6">
                                        <input type="checkbox" name="payment_methods[]" value="{{$paymentmethod->id}}"
                                            class="custom-control-input" id="paymentmethod_{{$paymentmethod->id}}"
                                            {{ in_array($paymentmethod->id, explode(",", $userdetail->payment_methods)) ? 'checked' : '' }}
                                            >
                                        <label class="custom-control-label" for="paymentmethod_{{$paymentmethod->id}}">{{$paymentmethod->payment_method}}</label>
                                    </div><!-- End .custom-checkbox -->
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
 
                                    <strong>Bank Info</strong>
                                    <textarea class="form-control" name="bank_info" id="bank_info">{{$userdetail->bank_info}}</textarea>

                            </div><!-- End .row -->
                            <div class="form-group">
                                <strong>Short Company Description</strong>
                                <textarea class="form-control" name="description" id="description">{{$userdetail->description}}</textarea>
                            </div>



                        </div><!-- End .collapse -->
                    </div><!-- End .checkout-discount -->


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