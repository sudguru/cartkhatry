@extends('layouts.admin')

@section('pagetitle')
Content Types - Admin
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
@endsection

@section('content')
<div class="d-flex align-items-center">
    <h2 class="pt-2 mb-0">Content Types</h2>
    <span class="ml-auto">
        <a href="/adm/contenttype/create" class="btn btn-outline-success btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </span>
</div>

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif
<div class="row justify-content-center mt-3">
    <div class="col-md-10">
        <ul class="list-group mt-2" id="my-ui-list">
            @foreach ($contenttypes as $contenttype)
            <li class="list-group-item d-flex" data-id="{{ $contenttype->id }}">
                <i class="{{ $contenttype->icon }} mr-4" style="font-size: 200%; min-width: 30px; text-align: center"></i>
                <a href='{{ route('contenttype.edit',$contenttype->id) }}'>{{ $contenttype->contenttype }}</a>
                <span class="ml-auto">
                    <a href="/adm/contenttype/{{ $contenttype->id }}" onclick="event.preventDefault();
                    if ( confirm('You are about to delete this item ?\n \'Cancel\' to stop, \'OK\' to delete.') ) { document.getElementById('delete-form-{{$contenttype->id}}').submit();}return false;">
                        <i class="fas fa-trash text-danger"></i>
                    </a>
                    <form id="delete-form-{{$contenttype->id}}" action="/adm/contenttype/{{ $contenttype->id }}" method="POST" style="display: none;">
                        @csrf
                        {{ method_field('delete') }}
                        <input type="hidden" name="id" value="{{ $contenttype->id }}" />
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
                    url:'/contenttype/sortit',
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
