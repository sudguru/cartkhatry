<div class="product-single-container product-single-default product-quick-view container">
        <div class="row">
            <div class="col-lg-6 col-md-6 product-single-gallery">
                <div class="product-slider-container product-item">
                    <div class="product-single-carousel owl-carousel owl-theme">
                        @foreach($product->pics as $pic)
                        <div class="product-item">
                            <img class="product-single-image" src="/storage/images/{{$product->user_id}}/thumb_400/{{$pic->pic_path}}" 
                            data-zoom-image="/storage/images/{{$product->user_id}}/original/{{$pic->pic_path}}"/>
                        </div>
                        @endforeach

                    </div>
                    <!-- End .product-single-carousel -->
                </div>
                <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                    @foreach($product->pics as $pic)
                    <div class="col-3 owl-dot">
                        <img src="/storage/images/{{$product->user_id}}/thumb_400/{{$pic->pic_path}}"/>
                    </div>
                    @endforeach
                </div>
            </div><!-- End .col-lg-7 -->
    
            <div class="col-lg-6 col-md-6">
                <div class="product-single-details">
                    <h1 class="product-title">{{$product->name}}</h1>
    
                    {{-- <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
    
                        <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div><!-- End .product-container --> --}}
    
                    <div class="price-box">
                        <span class="old-price">$81.00</span>
                        <span class="product-price">$101.00</span>
                    </div><!-- End .price-box -->
    
                    <div class="product-desc">
                        <p>{{$product->description}}</p>
                    </div><!-- End .product-desc -->
                    


                    <div class="toggle toggle-primary" data-plugin-toggle data-plugin-options="{ 'isAccordion': true }">
                        <section class="toggle active">
                            <label>Curabitur eget leo at velit imperdiet vague iaculis vitaes?</label>
                            <div class="toggle-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. </p>
                            </div>
                        </section>
                        <section class="toggle">
                            <label>Curabitur eget leo at velit imperdiet vague iaculis vitaes?</label>
                            <div class="toggle-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla, orci sit amet posuere auctor, orci eros pellentesque odio, nec pellentesque erat ligula nec massa. Aenean consequat lorem ut felis ullamcorper posuere gravida tellus faucibus. Maecenas dolor elit, pulvinar eu vehicula eu, consequat et lacus. Duis et purus ipsum. In auctor mattis ipsum id molestie. Donec risus nulla, fringilla a rhoncus vitae, semper a massa. Vivamus ullamcorper, enim sit amet consequat laoreet, tortor tortor dictum urna, ut egestas urna ipsum nec libero. Nulla justo leo, molestie vel tempor nec, egestas at massa. Aenean pulvinar, felis porttitor iaculis pulvinar, odio orci sodales odio, ac pulvinar felis quam sit.</p>
                            </div>
                        </section>
                        <section class="toggle">
                            <label>Curabitur eget leo at velit imperdiet vague iaculis vitaes?</label>
                            <div class="toggle-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla, orci sit amet posuere auctor, orci eros pellentesque odio, nec pellentesque erat ligula nec massa. Aenean consequat lorem ut felis ullamcorper posuere gravida tellus faucibus. Maecenas dolor elit, pulvinar eu vehicula eu, consequat et lacus. Duis et purus ipsum. In auctor mattis ipsum id molestie. Donec risus nulla, fringilla a rhoncus vitae, semper a massa. Vivamus ullamcorper, enim sit amet consequat laoreet, tortor tortor dictum urna, ut egestas urna ipsum nec libero. Nulla justo leo, molestie vel tempor nec, egestas at massa. Aenean pulvinar, felis porttitor iaculis pulvinar, odio orci sodales odio, ac pulvinar felis quam sit.</p>
                            </div>
                        </section>
                    </div>
                </div>
                      


    
                    <div class="product-filters-container">
                        <div class="product-single-filter">
                            <label>Colors:</label>
                            <ul class="config-swatch-list">
                                <li class="active">
                                    <a href="#" style="background-color: #6085a5;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #ab6e6e;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #b19970;"></a>
                                </li>
                                <li>
                                    <a href="#" style="background-color: #11426b;"></a>
                                </li>
                            </ul>
                        </div><!-- End .product-single-filter -->
                    </div><!-- End .product-filters-container -->
    
                    <div class="product-action">
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text">
                        </div><!-- End .product-single-qty -->
    
                        <a href="cart.html" class="paction add-cart" title="Add to Cart">
                            <span>Add to Cart</span>
                        </a>
                        <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                            <span>Add to Wishlist</span>
                        </a>
                        <a href="#" class="paction add-compare" title="Add to Compare">
                            <span>Add to Compare</span>
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