<div class="container">
    {{-- <div class="home-slider-container">
        <div class="home-slider owl-carousel owl-theme owl-theme-light">
            <div class="home-slide">
                <div class="slide-bg owl-lazy" data-src="d11/assets/images/slider/slide-1.jpg"></div><!-- End .slide-bg -->
                <div class="home-slide-content">
                    <div class="slide-title">
                        <h3>Furniture & Garden</h3>
                        <h1>Huge Sale</h1>
                    </div><!-- End .slide-title -->

                    <div class="slide-price">40<span class="slide-price-desc"><strong>%</strong>OFF</span></div><!-- End .slide-price -->
                    <a href="category.html" class="btn btn-dark">Shop Now</a>
                </div><!-- End .home-slide-content -->
            </div><!-- End .home-slide -->

            <div class="home-slide home-slide-left">
                <div class="slide-bg owl-lazy" data-src="d11/assets/images/slider/slide-2.jpg"></div><!-- End .slide-bg -->
                <div class="home-slide-content slide-content-dark">
                    <div class="slide-title">
                        <h3>Home Office Sale</h3>
                        <h1>Mega Off</h1>
                    </div><!-- End .slide-title -->

                    <div class="slide-price">40<span class="slide-price-desc"><strong>%</strong>OFF</span></div><!-- End .slide-price -->
                    <a href="category.html" class="btn btn-primary">Shop Now</a>
                </div><!-- End .home-slide-content -->
            </div><!-- End .home-slide -->
        </div><!-- End .home-slider -->
    </div><!-- End .home-slider-container --> --}}
    <div class="home-slider-container">
        <div class="home-slider owl-carousel owl-theme owl-theme-light">
            
            @foreach($hpSliders->banners as $banner)
            <div class="home-slide">
                <div class="slide-bg owl-lazy"  data-src="storage/banners/{{$banner->banner}}"></div><!-- End .slide-bg -->
            </div>
            @endforeach
        </div>
    </div>
</div><!-- End .container -->