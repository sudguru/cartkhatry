@extends('layouts.d11')
@section('pagetitle')
{{$product->name}}
@endsection

@section('extracss')

@endsection

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
            {{-- <li class="breadcrumb-item"><a href="#">Electronics</a></li>
            <li class="breadcrumb-item active" aria-current="page">Headsets</li> --}}
        </ol>
    </div>
</nav>
<input type="hidden" id="cart_product_id" value="{{$product->id}}" />
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-7 col-md-6 product-single-gallery">
                        <div class="product-slider-container product-item">
                            <div class="product-single-carousel owl-carousel owl-theme">
                                @foreach($product->pics as $key=>$pic)
                                @php
                                    if($key == 0) {
                                        $firstpic = $pic->pic_path;
                                    }
                                @endphp
                                <div class="product-item">
                                    <img class="product-single-image" src="/storage/images/{{$product->user_id}}/original/{{$pic->pic_path}}"
                                        data-zoom-image="/storage/images/{{$product->user_id}}/original/{{$pic->pic_path}}" />
                                </div>
                                @endforeach
                            </div>
                            <span class="prod-full-screen">
                                <i class="icon-plus"></i>
                            </span>
                        </div>
                        <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                            @foreach($product->pics as $pic)
                            <div class="col-3 owl-dot">
                                <img src="/storage/images/{{$product->user_id}}/thumb_400/{{$pic->pic_path}}" />
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6">
                        <div class="product-single-details">
                            <h1 class="product-title">{{$product->name}}</h1>

                            <div class="product-desc">
                                <p>{!!$product->description!!}</p>
                            </div>

                            <div style="margin-bottom: 2rem" class="product-filters-container">
                                <small>Prices</small>

                                <div id="product-price-detail" style="padding-top:2rem">
                                    <div class="price-box">
                                        @php
                                            $first_product_price  = $product->prices->first();
                                            $regular = $first_product_price->regular;
                                            $discounted = $first_product_price->discounted;

                                        @endphp

                                        @if( $regular == $discounted)
                                        <span class="product-price">Rs. {{$regular}}</span>
                                        @else
                                        <span class="old-price">Rs. {{$regular}}</span>
                                        <span class="product-price">Rs. {{$discounted}}</span>
                                        @endif
                                        
                                    </div>    
                                </div>
                            </div>

                            <div class="sticky-header">
                                <div class="container">
                                    <div class="sticky-img">
                                        <img class="sticky-img-" src="/storage/images/{{$product->user_id}}/thumb_400/{{$firstpic}}" />
                                    </div>
                                    <div class="sticky-detail">
                                        <div class="sticky-product-name">
                                            <h2 class="product-title">{{$product->name}}</h2>
                                            <div class="price-box">

                                                @if( $regular == $discounted)
                                                <span class="product-price" id="sticky-product-price">Rs. {{$regular}}</span> 
                                                @else
                                                <span class="old-price" id="sticky-old-price">Rs. {{$regular}}</span>
                                                <span class="product-price" id="sticky-product-price">Rs. {{$discounted}}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <a href="javascript:void(0)" class="paction add-cart btn-add-to-cart" title="Add to Cart">
                                        <span>Add to Cart</span>
                                    </a>
                                </div>
                            </div><!-- end .sticky-header -->

                            <div class="product-action product-all-icons">
                                <div class="product-single-qty">
                                    <input class="horizontal-quantity form-control" id="productQty" type="text">
                                </div><!-- End .product-single-qty -->

                                <a href="javascript:void(0)" class="paction add-cart btn-add-to-cart" title="Add to Cart">
                                    <span>Add to Cart</span>
                                </a>
                                <a href="javascript:void(0)" class="paction add-wishlist" title="Add to Wishlist">
                                    <span>Add to Wishlist</span>
                                </a>

                            </div><!-- End .product-action -->

                            <div class="product-single-share">
                                <label>Share:</label>
                                <!-- www.addthis.com share plugin-->
                                <div class="addthis_inline_share_toolbox"></div>
                            </div><!-- End .product single-share -->
                        </div><!-- End .product-single-details -->
                    </div><!-- End .col-lg-5 -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                            role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab"
                            aria-controls="product-tags-content" aria-selected="false">Specifications</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                                {!!$product->description!!}
                        </div><!-- End .product-desc-content -->
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                        <div class="product-tags-content">
                                {!!$product->specification!!}
                        </div><!-- End .product-tags-content -->
                    </div><!-- End .tab-pane -->

                </div><!-- End .tab-content -->
            </div><!-- End .product-single-tabs -->
        </div><!-- End .col-lg-9 -->

        <div class="sidebar-overlay"></div>
        <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
        <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
            <div class="sidebar-wrapper">
                {{-- <div class="widget widget-brand">
                    <a href="#">
                        <img src="assets/images/product-brand.png" alt="brand name">
                    </a>
                </div><!-- End .widget --> --}}

                <div class="widget widget-info">
                    <ul>
                        <li>
                            <i class="icon-shipping"></i>
                            <h4>SHIPPING<br>AVAILABLE</h4>
                        </li>
                        <li>
                            <i class="icon-us-dollar"></i>
                            <h4>100% MONEY<br>BACK GUARANTEE</h4>
                        </li>
                        <li>
                            <i class="icon-online-support"></i>
                            <h4>ONLINE<br>SUPPORT 24/7</h4>
                        </li>
                    </ul>
                </div><!-- End .widget -->

                <div class="widget widget-banner">
                    <div class="banner banner-image">
                        <a href="#">
                            <img src="/assets/images/banners/banner-sidebar.jpg" alt="Banner Desc">
                        </a>
                    </div><!-- End .banner -->
                </div><!-- End .widget -->

                <div class="widget widget-featured">
                    <h3 class="widget-title">Featured Products</h3>

                    <div class="widget-body">
                        <div class="owl-carousel widget-featured-products">
                            <div class="featured-col">
                                @foreach ($featureds as $key=>$featured)
                                @if ($key < 3)
                                @php
                                    if(count($featured->product->pics) > 0) {
                                        $image_path = '<img src="/storage/images/'.$featured->product['user_id'].'/thumb_400'.'/' . $featured->product->pics->first()->pic_path .'" />';
                                    } else {
                                        $image_path = "&nbsp;";
                                    }
                                    $regular = $featured->product->prices->min('regular');
                                    $discounted = $featured->product->prices->min('discounted');
                                    $off = (($regular -$discounted)/$regular)*100;
                                @endphp
                                <div class="product product-sm">
                                    <figure class="product-image-container">
                                        <a href="/product/{{$featured->product['slug']}}" class="product-image">
                                            {!!$image_path!!}
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="/product/{{$featured->product['slug']}}">{{$featured->product['name']}}</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">Rs. {{$discounted}}</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .product -->
                                @endif
                                @endforeach
                            </div><!-- End .featured-col -->


                        </div><!-- End .widget-featured-slider -->
                    </div><!-- End .widget-body -->
                </div><!-- End .widget -->
            </div>
        </aside><!-- End .col-md-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

{{-- <div class="featured-section">
    <div class="container">
        <h2 class="carousel-title">Similar Products</h2>

        <div class="featured-products owl-carousel owl-theme owl-dots-top">
            <div class="product">
                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="assets/images/products/product-1.jpg" alt="product">
                    </a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                </figure>
                <div class="product-details">
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <h2 class="product-title">
                        <a href="product.html">Felt Hat</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">$39.00</span>
                    </div><!-- End .price-box -->

                    <div class="product-action">
                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </a>

                        <a href="product.html" class="paction add-cart" title="Add to Cart">
                            <span>Add to Cart</span>
                        </a>

                        <a href="#" class="paction add-compare" title="Add to Compare">
                            <span>Add to Compare</span>
                        </a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->
            </div><!-- End .product -->

            <div class="product">
                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="assets/images/products/product-2.jpg" alt="product">
                    </a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                </figure>
                <div class="product-details">
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <h2 class="product-title">
                        <a href="product.html">Zippered Jacket</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">$55.00</span>
                    </div><!-- End .price-box -->

                    <div class="product-action">
                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </a>

                        <a href="product.html" class="paction add-cart" title="Add to Cart">
                            <span>Add to Cart</span>
                        </a>

                        <a href="#" class="paction add-compare" title="Add to Compare">
                            <span>Add to Compare</span>
                        </a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->
            </div><!-- End .product -->

            <div class="product">
                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="assets/images/products/product-3.jpg" alt="product">
                    </a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                </figure>
                <div class="product-details">
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:40%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <h2 class="product-title">
                        <a href="product.html">Brown Slippers</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">$12.90</span>
                    </div><!-- End .price-box -->

                    <div class="product-action">
                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </a>

                        <a href="product.html" class="paction add-cart" title="Add to Cart">
                            <span>Add to Cart</span>
                        </a>

                        <a href="#" class="paction add-compare" title="Add to Compare">
                            <span>Add to Compare</span>
                        </a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->
            </div><!-- End .product -->

            <div class="product">
                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="assets/images/products/product-4.jpg" alt="product">
                    </a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                </figure>
                <div class="product-details">
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <h2 class="product-title">
                        <a href="product.html">Black Slippers</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">$17.90</span>
                    </div><!-- End .price-box -->

                    <div class="product-action">
                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </a>

                        <a href="product.html" class="paction add-cart" title="Add to Cart">
                            <span>Add to Cart</span>
                        </a>

                        <a href="#" class="paction add-compare" title="Add to Compare">
                            <span>Add to Compare</span>
                        </a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->
            </div><!-- End .product -->

            <div class="product">
                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="assets/images/products/product-5.jpg" alt="product">
                    </a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                </figure>
                <div class="product-details">
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:50%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <h2 class="product-title">
                        <a href="product.html">Dean Cap Grey</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">$79.00</span>
                    </div><!-- End .price-box -->

                    <div class="product-action">
                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </a>

                        <a href="product.html" class="paction add-cart" title="Add to Cart">
                            <span>Add to Cart</span>
                        </a>

                        <a href="#" class="paction add-compare" title="Add to Compare">
                            <span>Add to Compare</span>
                        </a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-details -->
            </div><!-- End .product -->
        </div><!-- End .featured-proucts -->
    </div><!-- End .container -->
</div><!-- End .featured-section --> --}}
@endsection

@section('extrajs')

@endsection
