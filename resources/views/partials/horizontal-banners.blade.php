

<div class="container">
    <div class="row">
        @foreach ($banners->banners as $banner)
        <div class="col-md-4">
            {{-- <h3 class="subtitle">ABOUT US</h3> --}}
            <div class="banner banner-image">
                <a href="#">
                    <img src="/storage/banners/{{$banner->banner}}"  alt="{{$banner->title}}">
                </a>
                <div class="banner-meta">
                    <a href="{{$banner->link}}">{{$banner->title}}</a>

                    <!-- <span class="banner-price">Starting at <span>$999</span></span> -->
                </div><!-- End .banner-meta -->
            </div><!-- End .banner -->
        </div><!-- End .col-md-4 -->
        @endforeach
    </div><!-- End .row -->
</div><!-- End .container -->