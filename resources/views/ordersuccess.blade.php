@extends('layouts.d11')
@section('pagetitle')
Order Completed Successfully | {{$setting->site_name}}
@endsection

@section('extracss')

@endsection

@section('content')
@php
$cur = session('currency') ?? 'NPR';
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
                    <table class="table">
                        <tr>
                            <td>Product</td>
                            <td style="text-align: right">Rate</td>
                            <td style="text-align: right">Qty</td>
                            <td style="text-align: right">Total</td>
                        </tr>
                        @foreach($order->orderdetails as $orderdetail)
                        @php
                        $itemcurrency = $order->currency;
                        $itemrate = round(($orderdetail->rate/$exchangerates->$itemcurrency) * $exchangerates->$cur, 2);
                        $itemtotal = $orderdetail->qty * $itemrate;
                        $total = $total + $itemtotal;
                        @endphp
                        <tr>
                            <td>{{$orderdetail->productname}}</td>
                            <td style="text-align: right">{{number_format($orderdetail->rate, 2)}}</td>
                            <td style="text-align: right">{{number_format($orderdetail->qty, 2)}}</td>
                            <td style="text-align: right">{{$order->currency}} {{number_format($orderdetail->qty * $orderdetail->rate, 2)}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td style="font-weight: bold">TAX</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: right">0.00</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold">Totals</td>
                            <td>&nbsp;</td>
                            <td style="text-align: right; font-weight: bold"> {{$order->qty}}</td>
                            <td style="text-align: right; font-weight: bold">{{$order->currency}} {{$order->total}}</td>
                        </tr>
                    </table>
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

            </div>
            <div class="col-md-6">
                <h4>Vendor Infomation</h4>
                Khatry Online<br/>
                {{$setting->address}}<br/>
                {{$setting->phone1}}<br/>
                {{$setting->phone2}}<br/>
                <small>State:</small> {{$setting->state}}<br/>
                <small>Postal Code:</small> {{$setting->postal_code}}<br/>
                {{$setting->city}}, 
                {{$setting->country}}<br/>
                {{$setting->website}}<br/>
                <small>Skype:</small> {{$setting->skype}}<br/>
                <small>Viber:</small> {{$setting->viber}}<br/>
                <small>Whats App:</small> {{$setting->whatsapp}}<br/>
                <small>FaceBook:</small> <a href="{{$setting->facebook}}" target="_blank" class="text-info">{{$setting->facebook}}</a><br/>
                <small>Twitter:</small> <a href="{{$setting->twitter}}" target="_blank" class="text-info">{{$setting->twitter}}</a><br/>
                <small>Yoututbe:</small> <a href="{{$setting->youtube}}" target="_blank" class="text-info">{{$setting->youtube}}</a><br/>
                <div class="alert alert-info">
                    <small>Bank Instruction</small>
                    {{$setting->bank_info}}
                </div>
            </div>
        </div>
        


        
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
@endsection

@section('extrajs')
   
@endsection
