@extends('layouts.d11')

@section('pagetitle')
{{$setting->site_name}}
@endsection

@section('content')
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
    <div class="mb-3"></div><!-- margin -->
    @include('partials.home-featured')
    <div class="mb-5"></div><!-- margin -->
    @include('partials.horizontal-banners2')
    <div class="mb-3"></div><!-- margin -->
    @include('partials.home-top')
    <div class="mb-5"></div><!-- margin -->
    
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
