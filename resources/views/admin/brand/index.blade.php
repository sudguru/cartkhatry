@extends('layouts.admin')

@section('pagetitle')
Brands - Admin
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">

@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Brands</h2>
    <span class="ml-auto">
        <a href="/adm/brand/create" class="btn btn-outline-success btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </span>
</div>
@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="row justify-content-center mt-0">
    <div class="col-md-12">
        <ul class="list-group mt-2"  id="my-ui-list">
            @foreach ($brands as $brand)
            <li class="list-group-item d-flex align-items-center justify-content-between" data-id="{{ $brand->id }}"  style="cursor: 'move'">
                <span style="width: 70%">
                <a href='{{ route('brand.edit',$brand->id) }}'>{{$brand->brand }}</a>
                </span>
                <span class="ml-auto">
                    <a href="/adm/brand/{{ $brand->id }}" onclick="event.preventDefault();
                    if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$brand->id}}').submit();}return false;">
                        <i class="fas fa-trash text-danger"></i>
                    </a>
                    <form id="delete-form-{{$brand->id}}" action="/adm/brand/{{ $brand->id }}" method="POST" style="display: none;">
                        @csrf
                        {{ method_field('delete') }}
                        <input type="hidden" name="id" value="{{ $brand->id }}" />
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
                    type:'POST',
                    url:'/adm/brand/sortit',
                    data: data,
                    success:function(data){
                        console.log(data);
                    }
                });
            }
        }
    });

</script>

@endsection
