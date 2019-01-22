

<div class="container">
    <div class="row">
        @foreach ($bannersH2->banners as $banner)
        <div class="col-md-4">
            {{-- <h3 class="subtitle">ABOUT US</h3> --}}
            <div class="banner banner-image">
                <a href="{{$banner->link}}" target="_blank">
                    <img src="/storage/banners/{{$banner->banner}}"  alt="{{$banner->title}}">
                </a>

            </div><!-- End .banner -->
        </div><!-- End .col-md-4 -->
        @endforeach
    </div><!-- End .row -->
</div><!-- End .container -->