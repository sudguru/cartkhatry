<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">   
                    <ul id="message_ticker" class="welcome-msg">
                        @foreach($promos as $promo)
                            <li><span class="badge badge-warning">Ad</span>&nbsp; <a href="{{$promo->link}}" class="text-promo">{{$promo->title}}</a></li>
                        @endforeach
                    </ul>
            </div>

            <div class="header-right">
                <div class="header-dropdown dropdown-expanded">
                    <a href="#" style="font-weight: bold">Links</a>
                    <div class="header-menu">
                        <ul>
                            @guest
                                <li><a href="{{ route('login') }}">LOG IN</a></li>
                                <li><a href="{{ route('register') }}">SIGN UP</a></li>
                            @else
                                <li><a href="{{ route('account.dashboard') }}">MY ACCOUNT </a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        SIGN OUT
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest

                            
                            <li><a href="/wishlist">MY WISHLIST </a></li>
                            <li><a href="/blog">BLOG</a></li>
                            <li><a href="/contact">Contact</a></li>
                            
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <a href="/" class="logo">
                    <img src="/assets/images/logo.png" alt="">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    @foreach($categories as $parent)
                                    <option value="{{$parent->id}}">{{$parent->category}}</option>
                                    @if($parent->children)
                                        @foreach($parent->children as $child)
                                            <option value="{{$child->id}}"> -- {{$child->category}}</option>
                                            @if($child->children)
                                                @foreach($child->children as $grandchild)
                                                    <option value="{{$grandchild->id}}"> ---- {{$grandchild->category}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                    @endforeach
                                </select>
                            </div><!-- End .select-custom -->
                            <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div><!-- End .headeer-center -->

            <div class="header-right">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <div class="header-contact">
                    <span>Call us now</span>
                    <a href="tel:#"><strong>PHONE NUMBER</strong></a>
                </div><!-- End .header-contact -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <span class="cart-count">2</span>
                    </a>

                    <div class="dropdown-menu" >
                        <div class="dropdownmenu-wrapper">
                            <div class="dropdown-cart-products">
                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="product.html">Woman Ring</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            x $99.00
                                        </span>
                                    </div><!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="/assets/images/products/cart/product-1.jpg" alt="product">
                                        </a>
                                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                    </figure>
                                </div><!-- End .product -->

                                <div class="product">
                                    <div class="product-details">
                                        <h4 class="product-title">
                                            <a href="product.html">Woman Necklace</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">1</span>
                                            x $35.00
                                        </span>
                                    </div><!-- End .product-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="/assets/images/products/cart/product-2.jpg" alt="product">
                                        </a>
                                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                                    </figure>
                                </div><!-- End .product -->
                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>Total</span>

                                <span class="cart-total-price">$134.00</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="cart.html" class="btn">View Cart</a>
                                <a href="checkout-shipping.html" class="btn">Checkout</a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .dropdown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->

    <div class="header-bottom sticky-header">
        <div class="container">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li>
                        <a href="category.html" class="sf-with-ul">Categories</a>
                        <div class="megamenu megamenu-fixed-width">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="menu-title">
                                                <a href="#">Variations 1<span class="tip tip-new">New!</span></a>
                                            </div>
                                            <ul>
                                                <li><a href="category.html">Fullwidth Banner<span class="tip tip-hot">Hot!</span></a></li>
                                                <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                                                <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                                                <li><a href="category.html">Left Sidebar</a></li>
                                                <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                                <li><a href="category-flex-grid.html">Product Flex Grid</a></li>
                                                <li><a href="category-horizontal-filter1.html">Horizontal Filter1</a></li>
                                                <li><a href="category-horizontal-filter2.html">Horizontal Filter2</a></li>
                                            </ul>
                                        </div><!-- End .col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="menu-title">
                                                <a href="#">Variations 2</a>
                                            </div>
                                            <ul>
                                                <li><a href="#">Product List Item Types</a></li>
                                                <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a></li>
                                                <li><a href="category.html">3 Columns Products</a></li>
                                                <li><a href="category-4col.html">4 Columns Products <span class="tip tip-new">New</span></a></li>
                                                <li><a href="category-5col.html">5 Columns Products</a></li>
                                                <li><a href="category-6col.html">6 Columns Products</a></li>
                                                <li><a href="category-7col.html">7 Columns Products</a></li>
                                                <li><a href="category-8col.html">8 Columns Products</a></li>
                                            </ul>
                                        </div><!-- End .col-lg-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .col-lg-8 -->
                                <div class="col-lg-4">
                                    <div class="banner">
                                        <a href="#">
                                            <img src="/assets/images/menu-banner-2.jpg" alt="Menu banner">
                                        </a>
                                    </div><!-- End .banner -->
                                </div><!-- End .col-lg-4 -->
                            </div>
                        </div><!-- End .megamenu -->
                    </li>
                    <li class="megamenu-container">
                        <a href="product.html" class="sf-with-ul">Products</a>
                        <div class="megamenu">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="menu-title">
                                                <a href="#">Variations</a>
                                            </div>
                                            <ul>
                                                <li><a href="product.html">Horizontal Thumbnails</a></li>
                                                <li><a href="product-full-width.html">Vertical Thumbnails<span class="tip tip-hot">Hot!</span></a></li>
                                                <li><a href="product.html">Inner Zoom</a></li>
                                                <li><a href="product-addcart-sticky.html">Addtocart Sticky</a></li>
                                                <li><a href="product-sidebar-left.html">Accordion Tabs</a></li>
                                            </ul>
                                        </div><!-- End .col-lg-4 -->
                                        <div class="col-lg-4">
                                            <div class="menu-title">
                                                <a href="#">Variations</a>
                                            </div>
                                            <ul>
                                                <li><a href="product-sticky-tab.html">Sticky Tabs</a></li>
                                                <li><a href="product-simple.html">Simple Product</a></li>
                                                <li><a href="product-sidebar-left.html">With Left Sidebar</a></li>
                                            </ul>
                                        </div><!-- End .col-lg-4 -->
                                        <div class="col-lg-4">
                                            <div class="menu-title">
                                                <a href="#">Product Layout Types</a>
                                            </div>
                                            <ul>
                                                <li><a href="product.html">Default Layout</a></li>
                                                <li><a href="product-extended-layout.html">Extended Layout</a></li>
                                                <li><a href="product-full-width.html">Full Width Layout</a></li>
                                                <li><a href="product-grid-layout.html">Grid Images Layout</a></li>
                                                <li><a href="product-sticky-both.html">Sticky Both Side Info<span class="tip tip-hot">Hot!</span></a></li>
                                                <li><a href="product-sticky-info.html">Sticky Right Side Info</a></li>
                                            </ul>
                                        </div><!-- End .col-lg-4 -->
                                    </div><!-- End .row -->
                                </div><!-- End .col-lg-8 -->
                                <div class="col-lg-4">
                                    <div class="banner">
                                        <a href="#">
                                            <img class="product-promo" src="/assets/images/menu-banner.jpg" alt="Menu banner">
                                        </a>
                                    </div><!-- End .banner -->
                                </div><!-- End .col-lg-4 -->
                            </div>
                        </div><!-- End .megamenu -->
                    </li>
                    <li>
                        <a href="#" class="sf-with-ul">Pages</a>

                        <ul>
                            <li><a href="cart.html">Shopping Cart</a></li>
                            <li><a href="#">Checkout</a>
                                <ul>
                                    <li><a href="checkout-shipping.html">Checkout Shipping</a></li>
                                    <li><a href="checkout-shipping-2.html">Checkout Shipping 2</a></li>
                                    <li><a href="checkout-review.html">Checkout Review</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dashboard</a>
                                <ul>
                                    <li><a href="dashboard.html">Dashboard</a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single.html">Blog Post</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="#" class="login-link">Login</a></li>
                            <li><a href="forgot-password.html">Forgot Password</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="sf-with-ul">Features</a>
                        <ul>
                            <li><a href="#">Header Types</a></li>
                            <li><a href="#">Footer Types</a></li>
                        </ul>
                    </li>
                    <li class="float-right"><a href="/daily-deals">Daily Deals</a></li>
                    <li class="float-right"><a href="/sales">Sales !</a></li>
                </ul>
            </nav>
        </div><!-- End .header-bottom -->
    </div><!-- End .header-bottom -->
</header><!-- End .header -->