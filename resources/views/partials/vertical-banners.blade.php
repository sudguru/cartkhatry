@foreach ($bannersV->banners as $banner)
    <div class="row">
        
        <div class="col-md-12">
            {{-- <h3 class="subtitle">ABOUT US</h3> --}}
            <div class="banner banner-image">
                <a href="#">
                    <img src="/storage/banners/{{$banner->banner}}"  alt="{{$banner->title}}">
                </a>

            </div><!-- End .banner -->
        </div><!-- End .col-md-4 -->
        
    </div><!-- End .row -->
    @endforeach
