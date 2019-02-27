<div class="container">
    <h2 class="subtitle text-center">Featured Items</h2>

    <div class="top-selling-products owl-carousel owl-theme">
        @foreach ($featureds as $featured)
        @php
            if(count($featured->product->pics) > 0) {
                $image_path = '<img src="/storage/images/'.$featured->product['user_id'].'/thumb_400'.'/' . $featured->product->pics->first()->pic_path .'" />';
            } else {
                $image_path = "&nbsp;";
            }
            $regular = $featured->product->prices->min('regular');
            $discounted = $featured->product->prices->min('discounted');
            $regular1 = $regular == 0 ? 1 : $regular;
            $off = (($regular -$discounted)/$regular1)*100;
            $off = ceil($off);
            $addtocarttext = "Add to Cart";
            if($featured->product->paymentmanagedby == 'Self') $addtocarttext="Direct Order";
        @endphp
        <div class="product">
            <figure class="product-image-container">
                <a href="/product/{{$featured->product['slug']}}" class="product-image">
                    {!!$image_path!!}
                </a>
                <a href="ajax/product-quick-view/{{$featured->product['slug']}}" class="btn-quickview">Quick view</a>
                <a href="javascript:void(0)" class="paction add-cart btn-add-to-cart" title="{{$addtocarttext}}">
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
                    <a href="/product/{{$featured->product['slug']}}">{{$featured->product['name']}}</a>
                </h2>
                <div class="price-box">
                    <span class="old-price">
                            @php 
                                $productCurrency = $featured->product['primarycurrency'];
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
        @endforeach
 
    </div><!-- End .featured-proucts -->
</div><!-- End .container -->

