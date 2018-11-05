@extends('layouts.admin')

@section('pagetitle')
Product Categories - Admin
@endsection

@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/nestable/style.css') }}">
<style>
    .mydangeralert
    {
        border: 1px dotted red;
        border-radius: 10px;
        padding: 7px 20px;
        color: red;
        max-width: 300px;
    }
</style>
@endsection

@section('content')
<div class="d-flex align-items-center pb-3" style="border-bottom: 2px solid #ccc">
    <h2 class="pt-2 mb-0">Product Categories</h2>
</div>
@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="row justify-content-center mt-3">
        <div class="col-md-6">
            @include("admin.category.nestable")
        </div>
        <div class="col-md-6">
            @include("admin.category.form")
        </div>
    </div>
    
<div class="mb-5"></div>
@endsection

@section('extrajs')
<script src="{{ asset('assets/js/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('assets/js/nestable/jquery.nestableplus.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#changespending').hide();

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

    