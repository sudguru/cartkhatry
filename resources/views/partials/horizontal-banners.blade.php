<div class="banners-group">
    <div class="container">
        <div class="row">
            @foreach ($banners->banners as $banner)
            <div class="col-md-4">
                <div class="banner banner-image">
                    <a href="{{$banner->link}}">
                        <img src="/storage/banners/{{$banner->banner}}" alt="{{$banner->title}}">
                    </a>
                </div><!-- End .banner -->
            </div><!-- End .col-md-4 -->
            @endforeach
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .banneers-group -->