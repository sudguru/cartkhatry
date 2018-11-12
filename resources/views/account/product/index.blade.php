@extends('layouts.site')
@section('pagetitle')
Products
@endsection

@section('extracss')
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css">

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>My Products</h2>
            <div class="table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>Name</td>
                        <td>SKU</td>
                        <td>Stock</td>
                        <td>Level</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key=>$product)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td><a href="{{ route('account.product.edit', $product->id) }}">{{$product->name}}</a></td>
                        <td>{{$product->SKU}}</td>
                        <td class="{{ $product->stock <= $product->min_stock_level ? 'required' : '' }}">{{$product->stock}}</td>
                        <td>{{$product->min_stock_level}}</td>
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

@endsection

@section('extrajs')
<script src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
@endsection