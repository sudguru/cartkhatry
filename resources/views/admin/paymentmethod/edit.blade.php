@extends('layouts.admin')

@section('pagetitle')
Add New Payment Method - Admin
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Payment Method - Edit</h2>

</div>
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <form action="{{ route('paymentmethod.update', $paymentmethod->id) }}" method="POST" autocomplete="off" novalidate class="mb-1">

            @csrf
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input id="payment_method" type="text" class="form-control{{ $errors->has('payment_method') ? ' is-invalid' : '' }}" name="payment_method"
                    value="{{ old('payment_method') ?? $paymentmethod->payment_method }}" autofocus>

                @if ($errors->has('payment_method'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('payment_method') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-footer" style="margin-top: 0; padding-top:0">

                <button type="submit" class="btn btn-primary btn-md">Save Promo</button>
                <a class="btn btn-light btn-md" href="{{ route('paymentmethod.index') }}">Cancel</a>

            </div><!-- End .form-footer -->

        </form>
    </div>
</div>
@endsection
