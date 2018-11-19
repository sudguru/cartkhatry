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



<div class="row justify-content-center mt-3">
    
    
    <div class="col-md-7">
        <h4>Products in the List</h4>
        <ul class="list-group mt-2" id="my-ui-list">
            @foreach ($productlists as $productlist)
            <li class="list-group-item d-flex align-items-center justify-content-between" data-id="{{ $productlist->id }}"
                style="cursor: move">
                <span style="width: 70%">
                    <a href='{{ route('productlist.edit',$productlist->id) }}'>{{ $productlist->product['name']}}</a>
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
    <div class="col-md-1">&nbsp;</div>
    <div class="col-md-4">
        <h4>Available Products</h4>
        <ul class="list-group mt-3">
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


    var list = document.getElementById("my-ui-list");
    Sortable.create(list, {
        animation: 150,
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
            var rowid = $(this).parent().parent().attr('id');
            var product_id = rowid.split('-')[1];
            $('#'+rowid).remove();
            var data = {
                listname: "{{$listname}}",
                product_id: product_id,
                _token: '<?php echo csrf_token() ?>'
            };
            $.ajax({
                type: 'POST',
                url: '/adm/productlist',
                data: data,
                success: function (data) {
                    dataObj = JSON.parse(data);
                    if (data) {
                        var item = '<li class="list-group-item d-flex align-items-center justify-content-between" ' +
                            'data-id="'+dataObj.id+'" style="cursor: move">' +
                            '<span style="width: 70%">' +
                                '<a href="#">'+dataObj.name+'</a>' +
                            '</span>' +
                            '<span class="ml-auto">' +
                                '<a href="/adm/productlist/'+dataObj.id+'" onclick="event.preventDefault();' +
                                'if ( confirm(\'You are about to delete this item?\\n \\\'Cancel\\\' to stop, \\\'OK\\\' to delete.\') ) ' +
                                '{ document.getElementById(\'delete-form-'+dataObj.id+'\').submit();}return false;">' +
                                    '<i class="fas fa-trash text-danger"></i>' +
                                '</a>' +
                                '<form id="delete-form-'+dataObj.id+'" action="/adm/productlist/'+dataObj.id+'" method="POST" style="display: none;">' +
                                    '<input type="hidden" name="_token" value="'+dataObj.token+'">'+
                                    '<input type="hidden" name="_method" value="delete">'+
                                    '<input type="hidden" name="id" value="'+dataObj.id+'" />' +
                                '</form>' +
                            '</span>' +
                        '</li>';
                        console.log(item);
                        $('#my-ui-list').append(item);
                    }
                }
            });
        })
    });
</script>

@endsection