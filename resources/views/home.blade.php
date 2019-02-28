@extends('layouts.d11')

@section('pagetitle')
{{$setting->site_name}}
@endsection

@section('ogp')
<meta property="og:title" content="Khatry Online" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://www.khatryonline.com" />
<meta property="og:image" content="https://www.khatryonline.com/mainlogo.png" />
<meta property="og:description" content="Ecommerce Online website to facilitate transactions within Nepal and all around the globe." />
@endsection
@section('content')
    @php
    $cur = session('currency') ?? 'NPR';
    $outlet_id = session('outlet_id') ?? 0;
    $outlet_name = session('outlet_name') ?? 'All Outlets';
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
    @include('partials.home-new')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "31";
        $catname = 'Electronics & Computers';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "32";
        $catname = 'Toy & Hobbies';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "33";
        $catname = 'Home & Garden';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "34";
        $catname = 'Decor & Furniture';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "35";
        $catname = 'Sports & Fitness';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "36";
        $catname = 'Gift';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "37";
        $catname = 'Auto & Accessories';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "38,46,47";
        $catname = 'Handicrafts';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->
    
    @php
        $where = "51";
        $catname = 'Industrial Plants, Mechinery & Equipment';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "52,53,54,55";
        $catname = 'Apparel, Clothing & Garments';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "56";
        $catname = 'Food & Beverages';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->

    @php
        $where = "57";
        $catname = 'Mechanical Parts & Spares';
    @endphp
    @include('partials.home-category')
    <div class="mb-3"></div><!-- margin -->
@endsection
