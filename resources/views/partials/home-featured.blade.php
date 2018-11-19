<div class="featured-products-section carousel-section">
    <div class="container">
        <h2 class="h3 title mb-4 text-center">Featured Products</h2>

        <div class="featured-products owl-carousel owl-theme">
            @foreach ($featureds as $featured)
            <div class="product">
                    <figure class="product-image-container">
                        <a href="/product/{{$featured->product['slug']}}" class="product-image">
                            <img src="/storage/images/{{$featured->product['user_id']}}/thumb_400/{{$featured->product->pics->first()->pic_path}}" alt="product">
                        </a>
                        <a href="ajax/product-quick-view/{{$featured->product_id}}" class="btn-quickview">Quickviews</a>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                            </div>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">{{$featured->product['name']}}</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">Rs. {{$featured->product->prices->min('discounted')}}</span>
                        </div><!-- End .price-box -->
    
                        <div class="product-action">
                            <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                <span>Add to Wishlist</span>
                            </a>
    
                            <a href="/product/{{$featured->product['slug']}}" class="paction add-cart" title="View Detail">
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