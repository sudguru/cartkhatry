<div class="carousel-section">
    <div class="container">
        <h2 class="h3 title mb-4 text-center">New Arrivals</h2>
        
        <div class="new-products owl-carousel owl-theme">
                @foreach ($newarrivals as $newarrival)
                @php
                    if(count($newarrival->product->pics) > 0) {
                        $image_path = '<img src="/storage/images/'.$newarrival->product['user_id'].'/thumb_400'.'/' . $newarrival->product->pics->first()->pic_path .'" />';
                    } else {
                        $image_path = "";
                    }
                @endphp
                <div class="product">
                        <figure class="product-image-container">
                            <a href="/product/{{$newarrival->product['slug']}}" class="product-image">
                                {!!$image_path!!}
                            </a>
                            <a href="ajax/product-quick-view/{{$newarrival->product_id}}" class="btn-quickview">Quickviews</a>
                        </figure>
                        <div class="product-details">
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                </div>
                            </div>
                            <h2 class="product-title">
                                <a href="product.html">{{$newarrival->product['name']}}</a>
                            </h2>
                            <div class="price-box">
                                <span class="product-price">Rs. {{$newarrival->product->prices->min('discounted')}}</span>
                            </div><!-- End .price-box -->
        
                            <div class="product-action">
                                <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                    <span>Add to Wishlist</span>
                                </a>
        
                                <a href="/product/{{$newarrival->product['slug']}}" class="paction add-cart" title="View Detail">
                                    <span>View Detail</span>
                                </a>
        
                                <a href="#" class="paction add-compare" title="Add to Cart">
                                    <span>Add to Cart</span>
                                </a>
                            </div>
                        </div>
                    </div> 
                @endforeach


        </div>
    </div>
</div>