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
        <a href="/adm/banner/create?bannertype_id={{ isset($bannertype_id) ? $bannertype_id : '' }}" class="btn btn-outline-success btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </span>
</div>

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    @foreach ($bannertypes as $key=>$bannertype)
    <li class="nav-item">
        <a class="nav-link {{ ((isset($bannertype_id) && $bannertype_id == $bannertype->id) || $key == 0) ? 'active' : '' }}" id="pills-home-tab" data-toggle="pill" href="#pills-{{ $bannertype->id }}" role="tab" aria-controls="pills-{{ $bannertype->id }}" aria-selected="true">{{ $bannertype->bannertype }}</a>
    </li>
    @endforeach
</ul>
<div class="tab-content" id="pills-tabContent">
    @foreach ($bannertypes as $key=>$bannertype)
    <div class="tab-pane fade {{ ((isset($bannertype_id) && $bannertype_id == $bannertype->id) || $key == 0) ? 'show active' : '' }}" id="pills-{{ $bannertype->id }}" role="tabpanel" aria-labelledby="pills-home-tab">
        <ul class="list-group mt-2" id="list-{{ $bannertype->id }}">
            @foreach ($banners as $banner)
            @if($banner->bannertype_id == $bannertype->id)
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
        @endif
        @endforeach
    </ul>
</div>
@endforeach
</div>

<div class="row justify-content-start">
    <div class="col-md-12">
        <a href="{{ route('banner.index') }}">All</a>
        @foreach ($bannertypes as $bannertype)
        | <a href="{{ route('banner.index') }}?bannertype_id={{$bannertype->id}}">{{ $bannertype->bannertype}} </a>
        @endforeach
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
    
    @foreach($bannertypes as $bannertype)

    Sortable.create(document.getElementById("list-{{ $bannertype->id }}"), {
        animation: 150,
        store: {
            set: function (sortable) {

                $.ajax({
                    type:'POST',
                    url:'/banner/sortit',
                    data: {
                        order: sortable.toArray(),
                        _token: '<?php echo csrf_token() ?>'
                    },
                    success:function(data){
                        console.log(data);
                    }
                });
            }
        }
    });
    @endforeach

</script>

@endsection
