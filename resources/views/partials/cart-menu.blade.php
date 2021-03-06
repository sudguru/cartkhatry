<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
    <span class="cart-count">{{session('cart')->totalQty ?? 0}}</span>
</a>

<div class="dropdown-menu" >
    <div class="dropdownmenu-wrapper">
        @if(Session::has('cart'))
        <div class="dropdown-cart-header">
            <span>{{session('cart')->totalQty ?? 0}} Items</span>

            <a href="/viewcart">View Cart</a>
        </div><!-- End .dropdown-cart-header -->
        <div class="dropdown-cart-products">
            @php
                $total = 0;
            @endphp
            @foreach(session('cart')->items as $item)

            <div class="product">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="/product/{{$item['item']->slug}}">{{$item['item']->name}}</a>
                    </h4>

                    <span class="cart-product-info">
                        <span class="cart-product-qty">{{$item['qty']}}</span>
                        @php
                            $itemcurrency = $item['primarycurrency'];
                            $itemrate = round(($item['rate']/$exchangerates->$itemcurrency) * $exchangerates->$cur, 2);
                            $itemtotal = round($itemrate * $item['qty'],2);
                            $total = $total + $itemtotal;
                        @endphp
                        
                        x {{$cur }} {{number_format($itemrate,2)}} <br>
                        <span class="text-muted">Size:</span> <span style="color: #880000">{{$item['item']->size}}</span>
                    </span>
                </div><!-- End .product-details -->

                <figure class="product-image-container">
                    <a href="/product/{{$item['item']->slug}}" class="product-image">
                        {!!$item['item']->pic!!}
                    </a>
                    <a href="/cartremoveitem/{{$item['item']->id}}{{$item['item']->sizeslug}}" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                </figure>
            </div><!-- End .product -->
            @endforeach
            
        </div><!-- End .cart-product -->
        <div class="dropdown-cart-total">
                <span>Total</span>
    
                <span class="cart-total-price">
                    {{$cur }} {{number_format($total,2)}}
                </span>
            </div><!-- End .dropdown-cart-total -->
    
            <div class="dropdown-cart-action">
                <a href="/checkout" class="btn btn-block">Checkout</a>
            </div><!-- End .dropdown-cart-total -->
        @else 
            <div>Your cart is empty.</div>
        @endif
        

        
    </div><!-- End .dropdownmenu-wrapper -->
</div><!-- End .dropdown-menu -->