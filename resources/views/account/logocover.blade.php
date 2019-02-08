@extends('layouts.d11')
@section('pagetitle')
Logo Cover
@endsection
@section('extracss')
<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/customize_summernote.css') }}">
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

@if ($message = Session::get('success'))
<div id="snackbar">{{ $message }}</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">

            <h2>Logo & Cover Image</h2>
            <form action="{{ route('account.logo') }}" method="POST" enctype="multipart/form-data" id="thisForm"
                autocomplete="off" novalidate class="mb-1">

                @csrf
                <div class="row justify-content-center mt-3">
                    <div class="col-md-4" style="text-align: center">
                        <h3>Logo</h3>
                        <img src="/assets/images/banner-placeholder.jpg" style="width:100%; margin: 0 auto; cursor: pointer"
                            id="picImage" />
                        <small><em>Click the banner above to Add/Change</em></small>
                        <input type="file" name="banner" id="banner" class="{{ $errors->has('banner') ? 'is-invalid' : '' }}"
                            style="display: none" accept="image/x-png,image/gif,image/jpeg" />
                        @if ($errors->has('banner'))
                        <span class="required" role="alert">
                            <br><strong>{{ $errors->first('banner') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {
        $('#description').summernote({
            height: 150,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                ['height', ['height']],
                ['fullscreen']
            ]
        });
    });

</script>
<script>
    var x = document.getElementById("snackbar");
    if (x) {
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 3000);
    }

</script>
@endsection
