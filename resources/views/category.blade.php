@extends('layouts.d11')
@section('pagetitle')
{{$category->category}} | {{$setting->site_name}}
@endsection
{{-- 
    current_category
    secondary_category
    primary_category
--}}
@section('extracss')

@endsection

@section('content')
@php
$cur = session('currency') ?? 'NPR';
function getParentCategory($category_id, $flat_categories) {
    foreach($flat_categories as $category) {
        if($category->id == $category_id) {
            return $category->parent_id;
        }
    }
    return false;
}
function getCategoryName($category_id, $flat_categories) {
    foreach($flat_categories as $category) {
        if($category->id == $category_id) {
            return $category->category;
        } 
    }
    return false;
}

function getCategorySlug($category_id, $flat_categories) {
    foreach($flat_categories as $category) {
        if($category->id == $category_id) {
            return $category->slug;
        } 
    }
    return false;
}
@endphp
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
            <ol class="breadcrumb" style="border-top: 1px solid #efefef">
                    <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                    @if($father = getParentCategory($category->id, $flat_categories))
                        @if($grandfather = getParentCategory($father, $flat_categories))
                            <li class="breadcrumb-item">
                                <a href="/category/{{ getCategorySlug($grandfather, $flat_categories) }}">
                                    {{ getCategoryName($grandfather, $flat_categories) }}
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">
                            <a href="/category/{{ getCategorySlug($father, $flat_categories) }}">
                                {{ getCategoryName($father, $flat_categories) }}
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="/category/{{ getCategorySlug($category->id, $flat_categories) }}">
                            {{ getCategoryName($category->id, $flat_categories) }}
                        </a>
                    </li>
        
                </ol>
    </div><!-- End .container -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            @include('partials.category-slider')

            <nav class="toolbox">
                <div class="toolbox-left">
                    <div class="toolbox-item toolbox-sort">
                        <div class="select-custom">
                            <select name="orderby" class="form-control">
                                <option value="menu_order" selected="selected">Default sorting</option>
                                <option value="popularity">Sort by popularity</option>
                                {{-- <option value="rating">Sort by average rating</option> --}}
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </div><!-- End .select-custom -->

                        <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
                    </div><!-- End .toolbox-item -->
                </div><!-- End .toolbox-left -->

                <div class="toolbox-item toolbox-show">
                    <label>Showing 1–12 of 60 results</label>
                </div><!-- End .toolbox-item -->

                <div class="layout-modes">
                    <a href="#" class="layout-btn btn-grid active" title="Grid">
                        <i class="icon-mode-grid"></i>
                    </a>
                    <a href="#" class="layout-btn btn-list" title="List">
                        <i class="icon-mode-list"></i>
                    </a>
                </div><!-- End .layout-modes -->
            </nav>

            <div class="row row-sm">
                @foreach ($products as $prod)
                @php
                    if(count($prod->pics) > 0) {
                        $image_path = '<img src="/storage/images/'.$prod['user_id'].'/thumb_400'.'/' . $prod->pics->first()->pic_path .'" />';
                    } else {
                        $image_path = "&nbsp;";
                    }
                    $regular = $prod->prices->min('regular');
                    $discounted = $prod->prices->min('discounted');
                    $off = (($regular -$discounted)/$regular)*100;
                    $off = ceil($off);
                @endphp
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="product">
                            <figure class="product-image-container">
                                    <a href="/product/{{$prod['slug']}}" class="product-image">
                                        {!!$image_path!!}
                                    </a>
                                    <a href="ajax/product-quick-view/{{$prod['slug']}}" class="btn-quickview">Quick view</a>
                                    <a href="#" class="paction add-cart" title="Add to Cart">
                                        <span>Add to Cart</span>
                                    </a>
                                <span class="product-label label-sale">-{{$off}}%</span>
                                </figure>
                        <div class="product-details product-price-inner">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <h2 class="product-title">
                                    <a href="/product/{{$prod['slug']}}">{{$prod['name']}}</a>
                            </h2>
                            <div class="price-box">
                                    <span class="old-price">
                                            @php 
                                                $productCurrency = $prod['primarycurrency'];
                                                $decimals = 2;
                                                if ($regular > 999) {
                                                    $decimals = 0;
                                                }
                                            @endphp
                                            {{-- {{ ceil(round(($regular/$exchangerates->$productCurrency) *$exchangerates->$cur)*100) / 100 }} --}}
                                            {{ number_format(round(($regular/$exchangerates->$productCurrency) * $exchangerates->$cur, $decimals), $decimals) }}
                                    </span>
                
                                    <span class="product-price">
                                        {{ $cur }} 
                                        {{ number_format(round(($discounted/$exchangerates->$productCurrency) * $exchangerates->$cur, $decimals), $decimals) }}
                                    </span>
                            </div><!-- End .price-box -->
                        </div><!-- End .product-details -->
                    </div><!-- End .product -->
                </div><!-- End .col-xl-3 -->
                @endforeach
            </div><!-- End .row -->

            <nav class="toolbox toolbox-pagination">
                <div class="toolbox-item toolbox-show">
                    <label>Showing 1–12 of 60 results</label>
                </div><!-- End .toolbox-item -->

                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><span>...</span></li>
                    <li class="page-item"><a class="page-link" href="#">15</a></li>
                    <li class="page-item">
                        <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div><!-- End .col-lg-9 -->

        <aside class="sidebar-shop col-lg-3 order-lg-first">
            <div class="sidebar-wrapper">
                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-1" role="button" aria-expanded="true" aria-controls="widget-body-1">electronics</a>
                    </h3>

                    <div class="collapse show" id="widget-body-1">
                        <div class="widget-body">
                            <ul class="cat-list">
                                <li><a href="#">Smart TVs</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Head Phones</a></li>
                                <li><a href="#">Games</a></li>
                            </ul>
                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->

                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">Price</a>
                    </h3>

                    <div class="collapse show" id="widget-body-2">
                        <div class="widget-body">
                            <form action="#">
                                <div class="price-slider-wrapper">
                                    <div id="price-slider"></div><!-- End #price-slider -->
                                </div><!-- End .price-slider-wrapper -->

                                <div class="filter-price-action">
                                    <button type="submit" class="btn btn-primary">Filter</button>

                                    <div class="filter-price-text">
                                        <span id="filter-price-range"></span>
                                    </div><!-- End .filter-price-text -->
                                </div><!-- End .filter-price-action -->
                            </form>
                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->

                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Size</a>
                    </h3>

                    <div class="collapse show" id="widget-body-3">
                        <div class="widget-body">
                            <ul class="config-size-list">
                                <li><a href="#">S</a></li>
                                <li class="active"><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">XL</a></li>
                                <li><a href="#">2XL</a></li>
                                <li><a href="#">3XL</a></li>
                            </ul>
                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->

                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">Brands</a>
                    </h3>

                    <div class="collapse show" id="widget-body-4">
                        <div class="widget-body">
                            <ul class="cat-list">
                                <li><a href="#">Adidas <span>18</span></a></li>
                                <li><a href="#">Camel <span>22</span></a></li>
                                <li><a href="#">Seiko <span>05</span></a></li>
                                <li><a href="#">Samsung Galaxy <span>68</span></a></li>
                                <li><a href="#">Sony <span>03</span></a></li>
                            </ul>
                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->

                <div class="widget">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
                    </h3>

                    <div class="collapse show" id="widget-body-6">
                        <div class="widget-body">
                            <ul class="config-swatch-list">
                                <li>
                                    <a href="#" style="background-color: #4090d5;"></a>
                                </li>
                                <li class="active">
                                    <a href="#" style="background-color: #f5494a;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #fca309;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #11426b;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #f0f0f0;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #3fd5c9;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #979c1c;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #7d5a3c;"></a>
                                </li>
                            </ul>
                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->

                <div class="widget widget-featured">
                    <h3 class="widget-title">Featured Products</h3>
                    
                    <div class="widget-body">
                        <div class="owl-carousel widget-featured-products">
                            <div class="featured-col">
                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/small/product-1.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Ring</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$45.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->

                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/small/product-2.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Headphone</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:20%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">$60.00</span>
                                            <span class="product-price">$45.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->

                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/small/product-3.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Shoes</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$50.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                            </div><!-- End .featured-col -->

                            <div class="featured-col">
                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/small/product-4.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Watch-Black</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="old-price">$50.00</span>
                                            <span class="product-price">$35.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->

                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/small/product-5.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Watch-Gray</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$29.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->

                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/small/product-6.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Hat</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:20%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$40.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                            </div><!-- End .featured-col -->
                        </div><!-- End .widget-featured-slider -->
                    </div><!-- End .widget-body -->
                </div><!-- End .widget -->

                <div class="widget widget-block">
                    <h3 class="widget-title">Custom HTML Block</h3>
                    <h5>This is a custom sub-title.</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
                </div><!-- End .widget -->
            </div><!-- End .sidebar-wrapper -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- margin -->
@endsection

@section('extrajs')

@endsection
