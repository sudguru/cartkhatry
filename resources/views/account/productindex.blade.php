@extends('layouts.d11')
@section('pagetitle')
    My Products
@endsection

@section('extracss')
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
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
    
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <div class="d-flex justify-content-between">
                    <h2>Products</h2>
                    <a class="btn btn-sm btn-primary" style="height:36px; padding: .6rem 1.5rem" href="{{route('account.product.create')}}">New</a>
                </div>
    

    
                <div class="mb-4"></div><!-- margin -->
                <div class="table-responsive mt-2 mb-4">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Name</td>
                                <td>Brand</td>
                                <td>Category</td>
                                <td>Delivery</td>
                                <td>Delivery Charge</td>
                                <td>Del</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key=>$product)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><a href="{{ route('account.product.edit', $product->slug) }}">{{$product->name}}</a></td>
                                <td>{{$product->brand['brand']}}</td>
                                <td>{{$product->category['category']}}</td>
                                <td>{{ $product->delivery_available == 0 ? 'N/A' : $product->delivery_day_from . ' - ' . $product->delivery_day_to . ' days' }}</td>
                                <td>
                                    {{$product->delivery_charge_local}} / 
                                    {{$product->delivery_charge_intercity}} / 
                                    {{$product->delivery_charge_intl}}
                                </td>
                                <td>
                                    <a href="{{ route('product.destroy', $product->id) }}" onclick="event.preventDefault();
                                            if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$product->id}}').submit();}return false;">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-form-{{$product->id}}" action="{{ route('account.product.destroy', $product->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="id" value="{{ $product->id }}" />
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
            
                    </table>
                </div>

  
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

<script src="{{ asset('assets/js/bs4datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    "orderable": false
                },

            ]
        });

        var x = document.getElementById("snackbar");
        if (x) {
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    });

</script>
@endsection