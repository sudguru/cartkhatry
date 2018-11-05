<div class="info-boxes-container">
    <div class="container">
        @foreach($infoboxes as $infobox)
        <div class="info-box">
            <i class="{{$infobox->icon}}"></i>

            <div class="info-box-content">
                <h4>{{$infobox->title}}</h4>
                <p>
                    @if($infobox->link)
                        <a href="{{$infobox->link}}">{{$infobox->subtitle}}</a>
                    @else
                        {{$infobox->subtitle}}
                    @endif
                </p>
            </div><!-- End .info-box-content -->
        </div><!-- End .info-box -->
        @endforeach
    </div><!-- End .container -->
</div><!-- End .info-boxes-container -->