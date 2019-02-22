@extends('layouts.d11')
@section('pagetitle')
{{$product->name}} | {{$setting->site_name}}
@endsection

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
function xxxgetCategoryName($category_id, $categories) {
    foreach($categories as $category) {
        if($category->id == $category_id) {
            $categoryname = $category->category;
            return $categoryname;
        } else {
            if($category->children) {
                foreach($category->children as $child) {
                    if($child->id == $category_id) {
                        $categoryname = $child->category;
                        return $categoryname;
                    } else {
                        if($child->children) {
                            foreach($child->children as $grandchild) {
                                if($grandchild->id == $category_id) {
                                    $categoryname = $grandchild->category;
                                    return $categoryname;
                                }
                            }
                        } 
                    }
                }
            } 
        }
    }
    return false;
}

$addtocarttext = "Add to Cart";
if($product->paymentmanagedby == 'Self') $addtocarttext="Direct Order";
@endphp
<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb" style="border-top: 1px solid #efefef">
            <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
            @if($father = getParentCategory($product->category_id, $flat_categories))
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
                <a href="/category/{{ getCategorySlug($product->category_id, $flat_categories) }}">
                    {{ getCategoryName($product->category_id, $flat_categories) }}
                </a>
            </li>

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
                                @php

                                if(count($product->pics)>0) {
                                    $firstpic = $product->pics[0]->pic_path;
                                } else {
                                    $firstpic = '/assets/images/product-placeholder.jpg';
                                }
                                @endphp
                                    
                                @foreach($product->pics as $key=>$pic)
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
                                <ul class="config-size-list">
                                    @foreach($product->prices as $key=>$price)
                                        @php
                                            if($key == 0) {
                                                $pid = $price->id;
                                            }
                                            $r = $price->regular;
                                            $d = $price->discounted;
                                            $productCurrency = $product->primarycurrency;
                                            $rt = number_format(round(($r/$exchangerates->$productCurrency) * $exchangerates->$cur, 2), 2);
                                            $dt = number_format(round(($d/$exchangerates->$productCurrency) * $exchangerates->$cur, 2), 2);
                                            $st = $price->stock;
                                        @endphp
                                    <li class="{{ $key == 0 ? 'active' : '' }}">
                                        <a class="pricelink" href="javascript:void(0)" data-priceid="{{$price->id}}" data-stock="{{$st}}" data-regular="{{$rt}}" data-discounted="{{$dt}}">{{$price->size->size}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" id="txtpriceid" value="{{$pid}}">
                                
                                <div id="product-price-detail" style="padding-top:2rem">
                                    <div class="price-box">
                                        @foreach($product->prices as $key=>$price)
                                            @if($key == 0)
                                                @php
                                                    $r = $price->regular;
                                                    $d = $price->discounted;
                                                    $s = $price->stock;
                                                    $productCurrency = $product->primarycurrency;
                                                    $rt = number_format(round(($r/$exchangerates->$productCurrency) * $exchangerates->$cur, 2), 2);
                                                    $dt = number_format(round(($d/$exchangerates->$productCurrency) * $exchangerates->$cur, 2), 2);
                                                @endphp
                                                @if( $r == $d)
                                                <span class="product-price">{{$cur}} {{$rt}}</span>
                                                @else
                                                <span class="old-price">{{$rt}}</span>
                                                <span class="product-price">{{$cur}} {{$dt}}</span>
                                                @endif
                                            @endif
                                        @endforeach
                                       
                                        
                                    </div>    
                                    
                                </div>
                                <span id="stock_not_available" style="color: red">
                                    @if(is_null($s) or $s == 0)
                                    Out of Stock! Please try another size.
                                    @endif
                                </span>
                            </div>

                            <div class="sticky-header">
                                <div class="container">
                                    <div class="sticky-img">
                                        <img class="sticky-img-" src="{{$firstpic}}" />
                                    </div>
                                    <div class="sticky-detail">
                                        <div class="sticky-product-name">
                                            <h2 class="product-title">{{$product->name}}</h2>
                                            <div class="price-box">

                                                @if( $r == $d)
                                                <span class="product-price" id="sticky-product-price">Rs. {{$rt}}</span> 
                                                @else
                                                <span class="old-price" id="sticky-old-price">Rs. {{$rt}}</span>
                                                <span class="product-price" id="sticky-product-price">Rs. {{$dt}}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <a style="{{ (is_null($s) or $s == 0) ? 'display: none' : '' }}" href="javascript:void(0)" class="paction add-cart btn-add-to-cart" title="{{$addtocarttext}}">
                                        <span>{{$addtocarttext}}</span>
                                    </a>
                                </div>
                            </div><!-- end .sticky-header -->

                            <div class="product-action product-all-icons">
                                <div class="product-single-qty">
                                    <input class="horizontal-quantity form-control" id="productQty" type="text">
                                </div><!-- End .product-single-qty -->

                                <a style="{{ (is_null($s) or $s == 0) ? 'display: none' : '' }}" 
                             href="javascript:void(0)" class="paction add-cart btn-add-to-cart" title="{{$addtocarttext}}">
                                    <span>{{$addtocarttext}}</span>
                                </a>
                                <a href="javascript:void(0)" class="paction add-wishlist" title="Add to Wishlist">
                                    <span>Add to Wishlist</span>
                                </a>

                            </div><!-- End .product-action -->
                            @if($product->paymentmanagedby == 'Self')
                            <div class="alert alert-warning">
                                    IMPORTANT:<br/>
                                    <strong>This Product is not handled by {{$setting->site_name}}.</strong><br/> 
                                    You agree and understand that {{$setting->site_name}} is NOT involved in transaction of this particular product. 
                                    You are directly dealing with the party who has posted the Product, and agree not to hold {{$setting->site_name}} responsible for their act in any circumstances. We strongly encourage you to take necessary precaution.
                                    <br>Also, You CANNOT add this product to the cart, You can order only 1 product at a time. (Direct Order Only)
                            </div>
                            @endif

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
                @if($product->paymentmanagedby == 'Self')
                <div class="widget widget-info">
                    {{-- <ul>
                        <li> --}}
                            <small class="text-info">Vendor Contact Detail</small><br/>
                            {{$product->user->name}}<br/>
                            {{$product->user->userdetail->company_name ? $product->user->userdetail->company_name . '<br/>' : '' }}
                            {{$product->user->userdetail->address}}<br/>
                            {{$product->user->userdetail->phone}}<br/>
                            {{$product->user->userdetail->mobile}}<br/>
                            <small>State:</small> {{$product->user->userdetail->state}}<br/>
                            <small>Postal Code:</small> {{$product->user->userdetail->postal_code}}<br/>
                            {{$product->user->userdetail->city}}, 
                            {{$product->user->userdetail->country}}<br/>
                            {{$product->user->userdetail->website}}<br/>
                            <small>Skype:</small> {{$product->user->userdetail->skype}}<br/>
                            <small>Viber:</small> {{$product->user->userdetail->viber}}<br/>
                            <small>Whats App:</small> {{$product->user->userdetail->whatsapp}}<br/>
                            <small>FaceBook:</small> <a href="{{$product->user->userdetail->facebook}}" target="_blank" class="text-info">{{$product->user->userdetail->facebook}}</a><br/>
                            <small>Twitter:</small> <a href="{{$product->user->userdetail->twitter}}" target="_blank" class="text-info">{{$product->user->userdetail->twitter}}</a><br/>
                            <small>Yoututbe:</small> <a href="{{$product->user->userdetail->youtube}}" target="_blank" class="text-info">{{$product->user->userdetail->youtube}}</a><br/>
                            <div class="alert alert-info">
                                <small>Payment & Other Instruction</small>
                                {{$product->user->userdetail->paymentlink}}
                            </div>
                </div><!-- End .widget -->
                @else 
                <div class="widget widget-info">
                        <small class="text-info">Contact Detail</small><br/>
                        {{-- {{$product->user->name}}<br/> --}}
                        {{$setting->site_name}}<br/>
                        {{$setting->address}}<br/>
                        {{$setting->phone1}}<br/>
                        {{$setting->phone2}}<br/>
                        {{-- <small>State:</small> {{$setting->state}}<br/> --}}
                        {{-- <small>Postal Code:</small> {{$setting->postal_code}}<br/> --}}
                        {{-- {{$setting->city}},  --}}
                        {{-- {{$setting->country}}<br/> --}}
                        {{-- {{$setting->website}}<br/> --}}
                        <small>Skype:</small> {{$setting->skype}}<br/>
                        <small>Viber:</small> {{$setting->viber}}<br/>
                        <small>Whats App:</small> {{$setting->whatsapp}}<br/>
                        <small>FaceBook:</small> <a href="{{$setting->facebook}}" target="_blank" class="text-info">{{$setting->facebook}}</a><br/>
                        <small>Twitter:</small> <a href="{{$setting->twitter}}" target="_blank" class="text-info">{{$setting->twitter}}</a><br/>
                        <small>Yoututbe:</small> <a href="{{$setting->youtube}}" target="_blank" class="text-info">{{$setting->youtube}}</a><br/>
                        <div class="alert alert-info">
                            <small>Bank Info</small><br>
                            {{$setting->bank_info}}
                        </div>
                </div><!-- End .widget -->
                @endif

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


@endsection

@section('extrajs')
    <script>
        $(document).ready(function(){


            $('.pricelink').on('click', function(){
                var d = $(this).data('discounted');
                var r = $(this).data('regular');
                var s = $(this).data('stock');
                var priceid = $(this).data('priceid');
                $('#txtpriceid').val(priceid);
                $('.product-price').html("{{$cur}}"+ " " + d);
                $('.old-price').html(r);
                $(this).parent().siblings().removeClass('active');
                $(this).parent().addClass('active');
                if(s !== 1) {
                    $('#stock_not_available').text('Out of Stock! Please try another size.')
                    $('.btn-add-to-cart').hide();
                } else {
                    $('#stock_not_available').text('');
                    $('.btn-add-to-cart').show();    
                }
            });

            $('.btn-add-to-cart').on('click', function() {
                var qty = $('#productQty').val();
                var priceid = $('#txtpriceid').val();
                if($(this).attr('title') == 'Direct Order') {
                    window.location = "/checkoutdirect/{{$product->slug}}/" + qty + "/" + priceid;
                } else {
                    window.location = "/add-to-cart/{{$product->slug}}/" + priceid + "/" + qty;
                }
            });
        });
    </script>
@endsection
