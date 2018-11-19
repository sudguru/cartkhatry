@extends('layouts.admin')

@section('pagetitle')
Product LIst - Admin
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">

@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Product LIst</h2>
    <span class="ml-auto">
        <a href="/adm/productlist/create?listname={{ $listname }}" class="btn btn-outline-success btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </span>
</div>
@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="row justify-content-start">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('productlist.index') }}?listname=new" class="nav-link {{ $listname == 'new' ? 'active' : '' }}">NEW</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('productlist.index') }}?listname=featured" class="nav-link {{ $listname == 'featured' ? 'active' : '' }}">FEATURED</a>
            </li>
        </ul>
    </div>
</div>



<div class="row justify-content-center mt-0">
    <div class="col-md-4">
        <ul class="list-group mt-3" id="plist">
            @foreach($products as $product)
            <li class="list-group-item d-flex align-items-center justify-content-between" id="p-{{$product->id}}">
                <span style="width: 70%">
                    {{$product->name}}
                </span>
                <span class="ml-auto">
                    <a href='javascript:void(0)' class="addProduct"><i class="fas fa-plus"></i> Add</a>
                </span>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-1">&nbsp;</div>
    <div class="col-md-7">
        <ul class="list-group mt-2" id="my-ui-list">
            @foreach ($productlists as $productlist)
            <li class="list-group-item d-flex align-items-center justify-content-between" data-id="{{ $productlist->id }}"
                style="cursor: move">
                <span style="width: 70%">
                    <a href='{{ route('productlist.edit',$productlist->id) }}'>{{ $productlist->productlist }}</a>
                </span>
                <span class="ml-auto">
                    <a href="/adm/productlist/{{ $productlist->id }}" onclick="event.preventDefault();
                    if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$productlist->id}}').submit();}return false;">
                        <i class="fas fa-trash text-danger"></i>
                    </a>
                    <form id="delete-form-{{$productlist->id}}" action="/adm/productlist/{{ $productlist->id }}" method="POST"
                        style="display: none;">
                        @csrf
                        {{ method_field('delete') }}
                        <input type="hidden" name="id" value="{{ $productlist->id }}" />
                    </form>
                </span>
            </li>

            @endforeach
        </ul>
    </div>

</div>
<div class="mb-5"></div>
@endsection

@section('extrajs')
<script src="{{ asset('assets/js/sortable.min.js') }}"></script>
<script>
    var x = document.getElementById("snackbar");
    if (x) {
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    }

    var plist = document.getElementById("plist");
    Sortable.create(plist, { animation: 150, group: "omega" });
    var list = document.getElementById("my-ui-list");
    Sortable.create(list, {
        animation: 150,
        group: "omega",
        store: {
            get: function (sortable) {
                var order = sortable.toArray();
            },

            set: function (sortable) {
                var order = sortable.toArray();
                var data = {
                    order: order,
                    _token: '<?php echo csrf_token() ?>'
                };

                $.ajax({
                    type: 'POST',
                    url: '/productlist/sortit',
                    data: data,
                    success: function (data) {
                        console.log(data);
                    }
                });
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.addProduct').on('click', function(){
            var id = $(this).parent().parent().attr('id');
            var product_id = id.split('-')[1];
            alert(product_id);
        })
    });
</script>

@endsection