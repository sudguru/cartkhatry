@extends('layouts.admin')

@section('pagetitle')
Banner - Admin
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">

@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Banner</h2>
    <span class="ml-auto">
        <a href="/adm/banner/create?bannertype_id={{ $bannertype_id }}" 
        class="btn btn-outline-success btn-sm>
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
        @foreach ($bannertypes as $bannertype)
            <li class="nav-item">
                <a href="{{ route('banner.index') }}?bannertype_id={{$bannertype->id}}"
                class="nav-link {{ $bannertype_id == $bannertype->id ? 'active' : '' }}"
                >{{ $bannertype->bannertype}} </a>
            </li>
        @endforeach
        </ul>
    </div>
</div>



<div class="row justify-content-center mt-0">
    <div class="col-md-12">
        <ul class="list-group mt-2"  id="my-ui-list">
            @foreach ($banners as $banner)
            <li class="list-group-item d-flex align-items-center justify-content-between" data-id="{{ $banner->id }}"  style="cursor: {{ isset($bannertype_id) ? 'move' : '' }}">
                <span style="width: 70%">
                <a href='{{ route('banner.edit',$banner->id) }}'><img src="/storage/banners/{{ $banner->banner }}" /></a>
                </span>
                <span class="ml-auto">
                    <a href="/adm/banner/{{ $banner->id }}" onclick="event.preventDefault();
                    if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$banner->id}}').submit();}return false;">
                        <i class="fas fa-trash text-danger"></i>
                    </a>
                    <form id="delete-form-{{$banner->id}}" action="/adm/banner/{{ $banner->id }}" method="POST" style="display: none;">
                        @csrf
                        {{ method_field('delete') }}
                        <input type="hidden" name="id" value="{{ $banner->id }}" />
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
                    url:'/banner/sortit',
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
