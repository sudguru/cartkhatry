@extends('layouts.d11')
@section('pagetitle')
My Orders
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

            <h2>My Orders</h2>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>Date</td>
                        <td>Merchant</td>
                        <td>Tot Qty</td>
                        <td>Currency</td>
                        <td>Tot Amount</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($myorders as $key=>$myorder)
                    <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{$myorder->created_at->diffForHumans()}}</td>
                            <td>{{$myorder->merchant->name}}</td>
                            <td>{{$myorder->qty}}</td>
                            <td>{{$myorder->currency}}</td>
                            <td>{{$myorder->total}}</td>
                            <td class="{{$myorder->status ?? 'Unprocessed'}}">{{$myorder->status ?? 'Unprocessed'}}</td>
                        <td>
                            @if($myorder->status == 'Unprocessed' or is_null($myorder->status))
                            <a href="{{ route('account.order.cancel', $myorder->id) }}" onclick="event.preventDefault();
                                        if ( confirm('You are about to cancel this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$myorder->id}}').submit();}return false;">
                                <i class="fas fa-trash"></i>
                            </a>
                            <form id="delete-form-{{$myorder->id}}" action="{{ route('account.order.cancel', $myorder->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="id" value="{{ $myorder->id }}" />
                            </form>
                            @endif
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:void()"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
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
