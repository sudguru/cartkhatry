
<div class="container">
    <h2 class="subtitle text-center">Recent {{$catname}} Items</h2>

    <div class="top-selling-products owl-carousel owl-theme">
        @foreach ($allproducts as $prod)
        @if(in_array($prod->category_id, explode(',', $where)))
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
        @endif
        @endforeach
 
    </div><!-- End .prod-proucts -->
</div><!-- End .container -->

