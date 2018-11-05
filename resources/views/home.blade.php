@extends('layouts.site')

@section('content')
    @include('partials.home-slider')

    @include('partials.home-infoboxes')

    @include('partials.horizontal-banners')

    {{ Auth::id() }}
    @include('partials.home-featured')

    <div class="mb-5"></div>

    @include('partials.home-new')}}

    <div class="mb-5">
    </div>

    @include('partials.info-section')

    @include('partials.horizontal-promo')

    @include('partials.partners')

    @include('partials.home-blog')
@endsection
