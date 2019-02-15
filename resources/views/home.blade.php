@extends('layouts.d11')

@section('pagetitle')
{{$setting->site_name}}
@endsection

@section('content')
    @php
    $cur = $_GET['cur'] ?? 'NPR';
    $cur = filter_var($cur, FILTER_SANITIZE_STRING);
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="padding:0">
                @include('partials.home-slider')
            </div>
            <div class="col-md-4">
                @include('partials.vertical-banners')
            </div>
        </div>
    </div><!-- End .container -->
    @include('partials.horizontal-banners1')
    @include('partials.home-featured')
    <div class="mb-3"></div><!-- margin -->
    @include('partials.horizontal-banners2')
    @include('partials.home-top')
    @foreach($categories as $category)
        @if(is_null($category->parent_id))
            @include('partials.home-category')
        @endif

    @endforeach
    <div class="mb-3"></div><!-- margin -->
    
    {{-- 
    @include('partials.home-infoboxes')

    

    {{ Auth::id() }}
    @include('partials.home-featured')

    <div class="mb-5"></div>

    @include('partials.home-new')}}

    <div class="mb-5">
    </div>

    @include('partials.info-section')

    @include('partials.horizontal-promo')

    @include('partials.partners')

    @include('partials.home-blog') --}}
@endsection
