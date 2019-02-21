@extends('layouts.d11')
@section('pagetitle')
Order Completed Successfully | {{$setting->site_name}}
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
                <li class="breadcrumb-item active" aria-current="page">Order Successful</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">

        <h2 class="my-5">Thank You! Your Order has been successfully placed.</h2>
        <div class="row mb-5">
            <div class="col-md-6">
                    <h4>Order Information</h4>
                    <div class="alert alert-success">
                            {{$product->name}}
                    </div>
                    <small>Order Date:</small> {{$order->created_at}} GMT<br>
                    <small>Email:</small> {{$order->email}}<br>
                    <small>Name:</small> {{$order->name}}<br>
                    <small>Company:</small> {{$order->company}}<br>
                    <small>Address:</small> {{$order->address}}<br>
                    <small>City:</small> {{$order->city}}<br>
                    <small>Country:</small> {{$order->country}}<br>
                    <small>State:</small> {{$order->state}}<br>
                    <small>Postal Code:</small> {{$order->postalcode}}<br>
                    <small>Phone/ Mobile:</small> {{$order->phone}}<br>
                    <small>Quantity:</small> {{$order->qty}}<br>
                    <small>Total Quantity:</small> {{$order->total}}<br>
                    

            </div>
            <div class="col-md-6">
                <h4>Vendor Infomation</h4>
                {{$product->user->name}}<br/>
                {{$product->user->userdetail->company_name ? $product->user->userdetail->company_name . '<br/>' : '' }}
                {{$product->user->userdetail->address}}<br/>
                {{$product->user->userdetail->phone}}<br/>
                {{$product->user->userdetail->mobile}}<br/>
                <small>State:</small> {{$product->user->userdetail->state}}<br/>
                <small>Postal Code:</small> {{$product->user->userdetail->postal_code}}<br/>
                {{$product->user->userdetail->city}}, 
                {{$product->user->userdetail->country}}<br/>
                {{$product->user->userdetail->website}}<br/>
                <small>Skype:</small> {{$product->user->userdetail->skype}}<br/>
                <small>Viber:</small> {{$product->user->userdetail->viber}}<br/>
                <small>Whats App:</small> {{$product->user->userdetail->whatsapp}}<br/>
                <small>FaceBook:</small> <a href="{{$product->user->userdetail->facebook}}" target="_blank" class="text-info">{{$product->user->userdetail->facebook}}</a><br/>
                <small>Twitter:</small> <a href="{{$product->user->userdetail->twitter}}" target="_blank" class="text-info">{{$product->user->userdetail->twitter}}</a><br/>
                <small>Yoututbe:</small> <a href="{{$product->user->userdetail->youtube}}" target="_blank" class="text-info">{{$product->user->userdetail->youtube}}</a><br/>
                <div class="alert alert-info">
                    <small>Payment & Other Instruction</small>
                    {{$product->user->userdetail->paymentlink}}
                </div>
            </div>
        </div>
        


        
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
@endsection

@section('extrajs')
   
@endsection
