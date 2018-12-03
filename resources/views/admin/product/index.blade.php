@extends('layouts.admin')
@section('pagetitle')
Products
@endsection

@section('extracss')
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
@endsection

@section('content')

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif
<div class="container">


    <div class="d-flex justify-content-between">
        <h2>Products</h2>
        <a class="btn btn-sm btn-primary" style="height:36px; padding: .6rem 1.5rem" href="{{route('product.create')}}">New</a>
    </div>
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
                    <td><a href="{{ route('product.edit', $product->slug) }}">{{$product->name}}</a></td>
                    <td>{{$product->brand['brand']}}</td>
                    <td>{{$product->category['category']}}</td>
                    <td>{{ $product->delivery_available == 0 ? 'N/A' : $product->delivery_day_from . ' - ' . $product->delivery_day_to . ' days' }}</td>
                    <td>
                        {{$product->delivery_charge_local}} / 
                        {{$product->delivery_charge_intercity}} / 
                        {{$product->delivery_charge_intl}}
                    </td>
                    <td>
                        <a href="/account/product/{{ $product->id }}" onclick="event.preventDefault();
                                if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$product->id}}').submit();}return false;">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="delete-form-{{$product->id}}" action="/account/product/{{ $product->id }}" method="POST"
                            style="display: none;">
                            @csrf
                            {{ method_field('delete') }}
                            <input type="hidden" name="id" value="{{ $product->id }}" />
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div><!-- End .container -->

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
