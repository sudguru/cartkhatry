@extends('layouts.d11')

@section('pagetitle')
{{$setting->site_name}}
@endsection

@section('content')
    @include('partials.khatry.home-slider')
    @include('partials.khatry.horizontal-banners')
    <div class="mb-3"></div><!-- margin -->
    @include('partials.khatry.home-featured')
    <div class="mb-5"></div><!-- margin -->
    @include('partials.khatry.home-top')
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
