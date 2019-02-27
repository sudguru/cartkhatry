<div class="row">
    @foreach ($bannersV->banners as $key => $banner)

    @if($key <=1)
    <div class="col-md-6" style="padding: 0 7px">
        {{-- <h3 class="subtitle">ABOUT US</h3> --}}
        <div class="banner banner-image" style="margin-bottom: 29px">
            <a href="{{$banner->link}}" target="_blank">
                <img src="/storage/banners/{{$banner->banner}}" alt="{{$banner->title}}">
            </a>

        </div><!-- End .banner -->
    </div><!-- End .col-md-4 -->
    @endif
    @endforeach
</div><!-- End .row -->

<div class="row">
    @foreach ($bannersV->banners as $key => $banner)

    @if($key > 1 && $key <=3)
    <div class="col-md-6" style="padding: 0 7px">
        {{-- <h3 class="subtitle">ABOUT US</h3> --}}
        <div class="banner banner-image">
            <a href="{{$banner->link}}" target="_blank">
                <img src="/storage/banners/{{$banner->banner}}" alt="{{$banner->title}}">
            </a>

        </div><!-- End .banner -->
    </div><!-- End .col-md-4 -->
    @endif
    @endforeach
</div><!-- End .row -->
