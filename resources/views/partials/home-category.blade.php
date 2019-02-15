<div class="container">
    <h2 class="subtitle text-center">Recent {{$category->category}}</h2>

    <div class="top-selling-products owl-carousel owl-theme">
      
        @foreach ($products as $prod)
            {{json_encode($prod)}}
            <hr>
        @endforeach
 
    </div><!-- End .prod-proucts -->
</div><!-- End .container -->

